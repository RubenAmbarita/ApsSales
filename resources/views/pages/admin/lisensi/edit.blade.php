@extends('layouts.admin')

@section('title', 'Edit Lisensi')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Lisensi</h1>
        <a href="{{ route('admin.lisensi.index') }}" class="btn btn-sm btn-soft-teal btn-pill btn-elevated">
            <i class="fas fa-arrow-left fa-sm mr-1"></i> Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4 card-soft">
                <div class="card-body">
                    <style>
                        :root {
                            --soft-border: #e9edf5;
                            --soft-muted: #6c757d;
                            --primary: #4e73df;
                            /* Teal theme to match Export button */
                            --teal: #11998e;
                            --teal-soft: rgba(17,153,142,.12);
                            --teal-border: rgba(17,153,142,.30);
                        }
                        .card-soft { border: 1px solid var(--soft-border); border-radius: 12px; box-shadow: 0 6px 16px rgba(17, 24, 39, 0.06); }
                        .form-group label { font-weight: 700; color: #374151; }
                        .form-control { border-color: var(--soft-border); border-radius: 10px; padding: .625rem .75rem; }
                        .form-control:focus { border-color: var(--primary); box-shadow: 0 0 0 .15rem rgba(78,115,223,.15); }
                        .help-text { font-size: .85rem; color: var(--soft-muted); }
                        .required { color: #e74a3b; font-weight: 600; }
                        .btn-primary { border-radius: 10px; padding: .6rem 1rem; }
                        .btn-light-soft { background: #f9fbfd; border: 1px solid var(--soft-border); color: #374151; border-radius: 10px; }
                        /* Soft button aesthetics to match Create page */
                        .btn-pill { border-radius: 999px !important; }
                        .btn-elevated { box-shadow: 0 6px 14px rgba(17,24,39,.08); }
                        .btn-elevated:hover { box-shadow: 0 8px 18px rgba(17,24,39,.12); }
                        .btn-soft-primary { background-color: rgba(78,115,223,.12); color: #3b5ddd; border: 1px solid rgba(78,115,223,.30); }
                        .btn-soft-primary:hover { background-color: rgba(78,115,223,.20); color: #2e51d1; }
                        .btn-soft-teal { background-color: var(--teal-soft); color: var(--teal); border: 1px solid var(--teal-border); }
                        .btn-soft-teal:hover { background-color: rgba(17,153,142,.20); color: #0f8279; }
                        .monospace { font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace; }
                        .file-dropzone { border: 2px dashed var(--soft-border); border-radius: 12px; padding: 24px; text-align: center; background: #fbfdff; cursor: pointer; transition: border-color .2s, background .2s; }
                        .file-dropzone.dragover { border-color: var(--primary); background: rgba(78,115,223,.06); }
                        .dz-instruction { color: var(--soft-muted); }
                        .dz-filename { font-size: .9rem; color: #374151; }
                        /* Current file card styling (compact, noticeable) */
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

                    <form action="{{ route('admin.lisensi.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="id_vendor">Vendor</label>
                                    <select class="form-control @error('id_vendor') is-invalid @enderror" id="id_vendor" name="id_vendor">
                                        <option value="">-- Pilih Vendor --</option>
                                        @foreach($vendors as $v)
                                            <option value="{{ $v->id }}" {{ old('id_vendor', $item->id_vendor) == $v->id ? 'selected' : '' }}>{{ $v->name }}</option>
                                        @endforeach
                                    </select>
                                    <small class="help-text">Opsional, hubungkan lisensi ke vendor tertentu.</small>
                                    @error('id_vendor')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="software_name">Nama Software <span class="required">*</span></label>
                                    <input type="text" class="form-control @error('software_name') is-invalid @enderror" id="software_name" name="software_name" value="{{ old('software_name', $item->software_name) }}" placeholder="Contoh: Microsoft 365 Enterprise" required>
                                    <small class="help-text">Tuliskan nama software secara jelas.</small>
                                    @error('software_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="function">Fungsi <span class="required">*</span></label>
                                    <input type="text" class="form-control @error('function') is-invalid @enderror" id="function" name="function" value="{{ old('function', $item->function) }}" placeholder="Contoh: Kolaborasi, Email, Office Suite" required>
                                    <small class="help-text">Deskripsikan fungsi utama software.</small>
                                    @error('function')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="license_key">License Key <span class="required">*</span></label>
                                    <input type="text" class="form-control monospace @error('license_key') is-invalid @enderror" id="license_key" name="license_key" value="{{ old('license_key', $item->license_key) }}" placeholder="Masukkan license key" required>
                                    <small class="help-text">Gunakan format sesuai vendor. Disarankan disamarkan saat membagikan.</small>
                                    @error('license_key')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="assigned_to">Ditugaskan ke</label>
                                    <input type="text" class="form-control @error('assigned_to') is-invalid @enderror" id="assigned_to" name="assigned_to" value="{{ old('assigned_to', $item->assigned_to) }}" placeholder="Nama pengguna/unit">
                                    <small class="help-text">Opsional, isi jika lisensi terikat ke user/unit tertentu.</small>
                                    @error('assigned_to')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status">Status <span class="required">*</span></label>
                                    @php($statusOptions = ['Aktif','Nonaktif','Kadaluarsa'])
                                    <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                                        @foreach($statusOptions as $s)
                                            <option value="{{ $s }}" {{ old('status', $item->status) == $s ? 'selected' : '' }}>{{ $s }}</option>
                                        @endforeach
                                    </select>
                                    <small class="help-text">Pilih status lisensi saat ini.</small>
                                    @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="start_date">Tanggal Mulai <span class="required">*</span></label>
                                    <input type="date" class="form-control @error('start_date') is-invalid @enderror" id="start_date" name="start_date" value="{{ old('start_date', $item->start_date ? $item->start_date->format('Y-m-d') : '') }}" required>
                                    <small class="help-text">Tanggal berlakunya lisensi dimulai.</small>
                                    @error('start_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="expiry_date">Tanggal Berakhir <span class="required">*</span></label>
                                    <input type="date" class="form-control @error('expiry_date') is-invalid @enderror" id="expiry_date" name="expiry_date" value="{{ old('expiry_date', $item->expiry_date ? $item->expiry_date->format('Y-m-d') : '') }}" required>
                                    <small class="help-text">Tanggal kedaluwarsa lisensi.</small>
                                    @error('expiry_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="seats">Jumlah Seat <span class="required">*</span></label>
                                    <input type="text" class="form-control @error('seats') is-invalid @enderror" id="seats" name="seats" value="{{ old('seats', $item->seats) }}" placeholder="Contoh: 25" required>
                                    <small class="help-text">Jumlah lisensi/seat yang tersedia.</small>
                                    @error('seats')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="description">Deskripsi</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" placeholder="Deskripsi singkat lisensi, catatan, atau informasi tambahan...">{{ old('description', $item->description) }}</textarea>
                                    <small class="help-text">Opsional, tambahkan catatan penting atau informasi penunjang.</small>
                                    @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="file">Unggah File Lisensi</label>
                            <div class="row align-items-start">
                                <!-- Kiri: Unggah File Lisensi -->
                                <div class="col-md-6">
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
                                </div>

                                <!-- Kanan: File saat ini -->
                                <div class="col-md-6">
                                    @if($item->file)
                                        <div class="current-file-card">
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
                                    @else
                                        <div class="current-file-card">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1">
                                                    <div class="current-file-title">File saat ini</div>
                                                    <div class="current-file-name text-muted">Belum ada file tersimpan</div>
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

<!-- Modal Pratinjau File (lebih kecil & rapi) -->
<div class="modal fade" id="filePreviewModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document" style="max-width: 900px;">
    <div class="modal-content file-preview-modal">
      <div class="modal-header align-items-center">
        <div class="d-flex align-items-center">
          <i class="fas fa-file text-primary mr-2"></i>
          <div>
            <!-- Judul pratinjau dihilangkan sesuai permintaan -->
            <small class="text-muted" id="previewFileName">-</small>
          </div>
        </div>
        <div class="ml-auto">
          <a id="openInNewTab" href="#" target="_blank" class="btn btn-sm btn-outline-primary mr-2" aria-label="Buka di tab baru" title="Buka di tab baru"><i class="fas fa-external-link-alt"></i></a>
          <button type="button" class="btn btn-sm btn-light" data-dismiss="modal" aria-label="Tutup" title="Tutup"><i class="fas fa-times"></i></button>
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
  /* Preview button style to match SOP */
  .btn-preview {
    font-size: 0.78rem;
    padding: 0.34rem 0.6rem;
    border-radius: 999px;
    color: #0d6efd;
    background: rgba(13,110,253,0.08);
    border: 1px solid rgba(13,110,253,0.15);
    box-shadow: 0 2px 8px rgba(13,110,253,0.12);
    transition: all 0.2s ease-in-out;
  }
  .btn-preview:hover {
    background: rgba(13,110,253,0.12);
    color: #0b5ed7;
    box-shadow: 0 6px 16px rgba(13,110,253,0.18);
    text-decoration: none;
  }
  .btn-preview i { font-size: 0.82rem; margin-right: 0.3rem; }
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
        var name = (url || '').split('/').pop();
        $fileName.text(name || 'File');
      } catch (e) { $fileName.text('File'); }
    });

    $modal.on('hidden.bs.modal', function(){
      $frame.attr('src','');
      $openNew.attr('href','#');
      $fileName.text('-');
    });

    // Dropzone-like interactions
    var dropzone = document.getElementById('file-dropzone');
    var input = document.getElementById('file');
    var nameEl = document.getElementById('file-name');
    if(dropzone && input){
      var setName = function(files){ nameEl.textContent = (files && files[0]) ? files[0].name : ''; };
      dropzone.addEventListener('click', function(){ input.click(); });
      dropzone.addEventListener('dragover', function(e){ e.preventDefault(); dropzone.classList.add('dragover'); });
      dropzone.addEventListener('dragleave', function(){ dropzone.classList.remove('dragover'); });
      dropzone.addEventListener('drop', function(e){
        e.preventDefault();
        dropzone.classList.remove('dragover');
        if(e.dataTransfer && e.dataTransfer.files && e.dataTransfer.files.length){
            input.files = e.dataTransfer.files;
            setName(input.files);
        }
      });
      input.addEventListener('change', function(){ setName(input.files); });
    }
  });
</script>
@endsection