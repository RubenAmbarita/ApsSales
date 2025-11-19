@extends('layouts.admin')

@section('title', 'Edit SOP')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit SOP</h1>
        <a href="{{ route('admin.sop.index') }}" class="btn btn-sm btn-soft-teal btn-pill btn-elevated">
            <i class="fas fa-arrow-left fa-sm mr-1"></i> Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4 card-soft">
                <div class="card-body">
                    <style>
                        :root { --soft-border: #e9edf5; --soft-muted: #6c757d; --primary: #4e73df; --teal: #11998e; --teal-soft: rgba(17,153,142,.12); --teal-border: rgba(17,153,142,.30); }
                        .card-soft { border: 1px solid var(--soft-border); border-radius: 12px; box-shadow: 0 6px 16px rgba(17, 24, 39, 0.06); }
                        .form-group label { font-weight: 700; color: #374151; }
                        .form-control { border-color: var(--soft-border); border-radius: 10px; padding: .625rem .75rem; }
                        .form-control:focus { border-color: var(--primary); box-shadow: 0 0 0 .15rem rgba(78,115,223,.15); }
                        .help-text { font-size: .85rem; color: var(--soft-muted); }
                        .required { color: #e74a3b; font-weight: 600; }
                        .btn-pill { border-radius: 999px !important; }
                        .btn-elevated { box-shadow: 0 6px 14px rgba(17,24,39,.08); }
                        .btn-elevated:hover { box-shadow: 0 8px 18px rgba(17,24,39,.12); }
                        .btn-soft-primary { background-color: rgba(78,115,223,.12); color: #3b5ddd; border: 1px solid rgba(78,115,223,.30); }
                        .btn-soft-primary:hover { background-color: rgba(78,115,223,.20); color: #2e51d1; }
                        .btn-soft-teal { background-color: var(--teal-soft); color: var(--teal); border: 1px solid var(--teal-border); }
                        .btn-soft-teal:hover { background-color: rgba(17,153,142,.20); color: #0f8279; }
                        .file-dropzone { border: 2px dashed var(--soft-border); border-radius: 12px; padding: 24px; text-align: center; background: #fbfdff; cursor: pointer; transition: border-color .2s, background .2s; }
                        .file-dropzone.dragover { border-color: var(--primary); background: rgba(78,115,223,.06); }
                        .dz-instruction { color: var(--soft-muted); }
                        .dz-filename { font-size: .9rem; color: #374151; }
                        .current-file-card { border: 1px solid var(--soft-border); border-left: 4px solid rgba(78,115,223,.35); border-radius: 12px; background: #fbfdff; padding: 10px; }
                        .current-file-title { font-weight: 700; color: #374151; font-size: .95rem; }
                        .current-file-name { color: var(--soft-muted); font-size: .9rem; }
                        .file-icon { width: 36px; height: 36px; border-radius: 10px; display: inline-flex; align-items: center; justify-content: center; background: rgba(78,115,223,.12); color: #3b5ddd; }
                        .type-badge { display: inline-block; font-size: .75rem; background: rgba(78,115,223,.12); color: #3b5ddd; border: 1px solid rgba(78,115,223,.30); border-radius: 999px; padding: 2px 8px; margin-left: 8px; }
                        .type-badge i { font-size: .8rem; vertical-align: -1px; }
                        .btn-preview { font-size: .75rem; padding: .25rem .55rem; line-height: 1; border-radius: 999px; background: rgba(78,115,223,.12); color: #2e51d1; border: 1px solid rgba(78,115,223,.30); box-shadow: 0 3px 8px rgba(17,24,39,.06); }
                        .btn-preview:hover { background: rgba(78,115,223,.18); color: #1f46c9; box-shadow: 0 5px 12px rgba(17,24,39,.10); }
                        .btn-preview i { font-size: .75rem; }
                    </style>

                    <form action="{{ route('admin.sop.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_sop">No SOP <span class="required">*</span></label>
                                    <input type="text" class="form-control @error('no_sop') is-invalid @enderror" id="no_sop" name="no_sop" value="{{ old('no_sop', $item->no_sop) }}" required>
                                    @error('no_sop')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Nama SOP <span class="required">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $item->name) }}" required>
                                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="version">Versi <span class="required">*</span></label>
                                    <input type="text" class="form-control @error('version') is-invalid @enderror" id="version" name="version" value="{{ old('version', $item->version) }}" required>
                                    @error('version')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="retention_period">Masa Retensi <span class="required">*</span></label>
                                    <input type="text" class="form-control @error('retention_period') is-invalid @enderror" id="retention_period" name="retention_period" value="{{ old('retention_period', $item->retention_period) }}" required>
                                    @error('retention_period')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="id_department">Pemilik (Departemen) <span class="required">*</span></label>
                                    <select class="form-control select2 @error('id_department') is-invalid @enderror" id="id_department" name="id_department" required>
                                        <option value="">-- Pilih Departemen --</option>
                                        @isset($departments)
                                            @foreach($departments as $dept)
                                                <option value="{{ $dept->id }}" {{ old('id_department', $item->id_department) == $dept->id ? 'selected' : '' }}>{{ $dept->name }}</option>
                                            @endforeach
                                        @endisset
                                    </select>
                                    @error('id_department')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="effective_date">Tanggal Berlaku <span class="required">*</span></label>
                                    <input type="date" class="form-control @error('effective_date') is-invalid @enderror" id="effective_date" name="effective_date" value="{{ old('effective_date', $item->effective_date ? $item->effective_date->format('Y-m-d') : '') }}" required>
                                    @error('effective_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="approved_by">Disetujui Oleh <span class="required">*</span></label>
                                    <input type="text" class="form-control @error('approved_by') is-invalid @enderror" id="approved_by" name="approved_by" value="{{ old('approved_by', $item->approved_by) }}" required>
                                    @error('approved_by')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="file">Unggah File SOP</label>
                                    <div id="file-dropzone" class="file-dropzone">
                                        <input type="file" class="@error('file') is-invalid @enderror d-none" id="file" name="file" accept=".pdf,.doc,.docx,.png,.jpg,.jpeg">
                                        <div class="dz-instruction">
                                            <i class="fas fa-cloud-upload-alt mr-2"></i>
                                            <span>Tarik & letakkan file ke sini, atau klik untuk pilih</span>
                                            <div class="text-muted small mt-1">Format didukung: PDF, DOC/DOCX, PNG, JPG (maks. 5MB).</div>
                                        </div>
                                        <div id="file-name" class="dz-filename mt-2"></div>
                                    </div>
                                    @error('file')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                    @if($item->file)
                                        <div class="current-file-card mt-3">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1">
                                                    <div class="current-file-title">File saat ini
                                                        @php($ext = strtolower(pathinfo($item->file, PATHINFO_EXTENSION)))
                                                        <span class="type-badge">
                                                            @if ($ext === 'pdf')
                                                                <i class="fas fa-file-pdf text-danger mr-1"></i> PDF
                                                            @elseif ($ext === 'doc' || $ext === 'docx')
                                                                <i class="fas fa-file-word text-primary mr-1"></i> DOCX
                                                            @elseif (in_array($ext, ['jpg','jpeg','png','gif','webp']))
                                                                <i class="fas fa-file-image text-warning mr-1"></i> {{ strtoupper($ext) }}
                                                            @else
                                                                <i class="fas fa-file text-secondary mr-1"></i> {{ strtoupper($ext) }}
                                                            @endif
                                                        </span>
                                                    </div>
                                                    <div class="current-file-name">{{ basename($item->file) }}</div>
                                                    <div class="mt-2">
                                                        <a href="#" class="btn btn-preview" data-toggle="modal" data-target="#filePreviewModal" data-file-url="{{ asset('storage/'.$item->file) }}"><i class="fas fa-file mr-1"></i> Lihat File</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end align-items-center mt-3">
                            <button type="submit" class="btn btn-soft-primary btn-pill btn-elevated"><i class="fas fa-save mr-1"></i> Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<!-- Modal Pratinjau File -->
<div class="modal fade" id="filePreviewModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document" style="max-width: 900px;">
    <div class="modal-content file-preview-modal">
      <div class="modal-header align-items-center">
        <div class="d-flex align-items-center">
          <i class="fas fa-file text-primary mr-2"></i>
          <div>
            <small class="text-muted" id="previewFileName">-</small>
          </div>
        </div>
        <div class="ml-auto">
          <a id="openInNewTab" href="#" target="_blank" class="btn btn-sm btn-outline-primary mr-2"><i class="fas fa-external-link-alt"></i></a>
          <button type="button" class="btn btn-sm btn-light" data-dismiss="modal"><i class="fas fa-times"></i></button>
        </div>
      </div>
      <div class="modal-body p-0">
        <div class="file-preview-frame-wrapper">
          <iframe id="filePreviewFrame" src="" width="100%" height="100%" style="border:0;" allowfullscreen></iframe>
        </div>
      </div>
    </div>
  </div>
</div>

@section('scripts')
<style>
  .file-preview-modal { border-radius: 14px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.08); }
  .file-preview-modal .modal-header { background: #f8fafc; border-bottom: 1px solid #e9ecef; }
  .file-preview-frame-wrapper { height: 60vh; background: #fff; }
  @media (max-width: 768px) { .file-preview-frame-wrapper { height: 65vh; } }
</style>
<script>
  $(function(){
    var $modal = $('#filePreviewModal');
    var $frame = $('#filePreviewFrame');
    var $openNew = $('#openInNewTab');
    var $fileName = $('#previewFileName');

    $modal.on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      var url = button.data('file-url');
      $frame.attr('src', url);
      $openNew.attr('href', url);
      try {
        var parsed = new URL(url);
        $fileName.text(parsed.pathname.split('/').pop());
      } catch (e) { $fileName.text('File'); }
    });
  });
</script>
@endsection