@extends('layouts.admin')

@section('title', 'Tambah Lisensi')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Tambah Lisensi</h1>
        </div>
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
                        /* Soft button aesthetics to match Index page */
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
                    </style>

                    <form action="{{ route('admin.lisensi.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="id_vendor">Vendor</label>
                                    <select class="form-control @error('id_vendor') is-invalid @enderror" id="id_vendor" name="id_vendor">
                                        <option value="">-- Pilih Vendor --</option>
                                        @foreach($vendors as $v)
                                            <option value="{{ $v->id }}" {{ old('id_vendor') == $v->id ? 'selected' : '' }}>{{ $v->name }}</option>
                                        @endforeach
                                    </select>
                                    <small class="help-text">Opsional, hubungkan lisensi ke vendor tertentu.</small>
                                    @error('id_vendor')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="software_name">Nama Software <span class="required">*</span></label>
                                    <input type="text" class="form-control @error('software_name') is-invalid @enderror" id="software_name" name="software_name" value="{{ old('software_name') }}" placeholder="Contoh: Microsoft 365 Enterprise" required>
                                    <small class="help-text">Tuliskan nama software secara jelas.</small>
                                    @error('software_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="function">Fungsi <span class="required">*</span></label>
                                    <input type="text" class="form-control @error('function') is-invalid @enderror" id="function" name="function" value="{{ old('function') }}" placeholder="Contoh: Kolaborasi, Email, Office Suite" required>
                                    <small class="help-text">Deskripsikan fungsi utama software.</small>
                                    @error('function')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="license_key">License Key <span class="required">*</span></label>
                                    <input type="text" class="form-control monospace @error('license_key') is-invalid @enderror" id="license_key" name="license_key" value="{{ old('license_key') }}" placeholder="Masukkan license key" required>
                                    <small class="help-text">Gunakan format sesuai vendor. Disarankan disamarkan saat membagikan.</small>
                                    @error('license_key')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="assigned_to">Ditugaskan ke</label>
                                    <input type="text" class="form-control @error('assigned_to') is-invalid @enderror" id="assigned_to" name="assigned_to" value="{{ old('assigned_to') }}" placeholder="Nama pengguna/unit">
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
                                            <option value="{{ $s }}" {{ old('status') == $s ? 'selected' : '' }}>{{ $s }}</option>
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
                                    <input type="date" class="form-control @error('start_date') is-invalid @enderror" id="start_date" name="start_date" value="{{ old('start_date') }}" required>
                                    <small class="help-text">Tanggal berlakunya lisensi dimulai.</small>
                                    @error('start_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="expiry_date">Tanggal Berakhir <span class="required">*</span></label>
                                    <input type="date" class="form-control @error('expiry_date') is-invalid @enderror" id="expiry_date" name="expiry_date" value="{{ old('expiry_date') }}" required>
                                    <small class="help-text">Tanggal kedaluwarsa lisensi.</small>
                                    @error('expiry_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="seats">Jumlah Seat <span class="required">*</span></label>
                                    <input type="text" class="form-control @error('seats') is-invalid @enderror" id="seats" name="seats" value="{{ old('seats') }}" placeholder="Contoh: 25" required>
                                    <small class="help-text">Jumlah lisensi/seat yang tersedia.</small>
                                    @error('seats')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="description">Deskripsi</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" placeholder="Deskripsi singkat lisensi, catatan, atau informasi tambahan...">{{ old('description') }}</textarea>
                                    <small class="help-text">Opsional, tambahkan catatan penting atau informasi penunjang.</small>
                                    @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="file">Unggah File Lisensi</label>
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

    var setName = function(files){
        nameEl.textContent = (files && files[0]) ? files[0].name : '';
    };

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
});
</script>
@endsection