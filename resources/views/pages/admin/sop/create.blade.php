@extends('layouts.admin')

@section('title', 'Tambah SOP')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Tambah SOP</h1>
        </div>
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
                    </style>

                    <form action="{{ route('admin.sop.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_sop">No SOP <span class="required">*</span></label>
                                    <input type="text" class="form-control @error('no_sop') is-invalid @enderror" id="no_sop" name="no_sop" value="{{ old('no_sop') }}" required>
                                    @error('no_sop')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Nama SOP <span class="required">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="version">Versi <span class="required">*</span></label>
                                    <input type="text" class="form-control @error('version') is-invalid @enderror" id="version" name="version" value="{{ old('version') }}" required>
                                    @error('version')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="retention_period">Masa Retensi <span class="required">*</span></label>
                                    <input type="text" class="form-control @error('retention_period') is-invalid @enderror" id="retention_period" name="retention_period" value="{{ old('retention_period') }}" required>
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
                                                <option value="{{ $dept->id }}" {{ old('id_department') == $dept->id ? 'selected' : '' }}>{{ $dept->name }}</option>
                                            @endforeach
                                        @endisset
                                    </select>
                                    @error('id_department')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="effective_date">Tanggal Berlaku <span class="required">*</span></label>
                                    <input type="date" class="form-control @error('effective_date') is-invalid @enderror" id="effective_date" name="effective_date" value="{{ old('effective_date') }}" required>
                                    @error('effective_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="approved_by">Disetujui Oleh <span class="required">*</span></label>
                                    <input type="text" class="form-control @error('approved_by') is-invalid @enderror" id="approved_by" name="approved_by" value="{{ old('approved_by') }}" required>
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

<script>
document.addEventListener('DOMContentLoaded', function(){
    var dropzone = document.getElementById('file-dropzone');
    var input = document.getElementById('file');
    var nameEl = document.getElementById('file-name');
    if(!dropzone || !input) return;

    var setName = function(files){ nameEl.textContent = (files && files[0]) ? files[0].name : ''; };
    dropzone.addEventListener('click', function(){ input.click(); });
    dropzone.addEventListener('dragover', function(e){ e.preventDefault(); dropzone.classList.add('dragover'); });
    dropzone.addEventListener('dragleave', function(){ dropzone.classList.remove('dragover'); });
    dropzone.addEventListener('drop', function(e){ e.preventDefault(); dropzone.classList.remove('dragover'); if(e.dataTransfer && e.dataTransfer.files && e.dataTransfer.files.length){ input.files = e.dataTransfer.files; setName(input.files); } });
    input.addEventListener('change', function(){ setName(input.files); });
});
</script>
@endsection