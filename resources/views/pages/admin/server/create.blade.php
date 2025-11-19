@extends('layouts.admin')

@section('title', 'Tambah Server')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Tambah Server</h1>
        </div>
        <a href="{{ route('admin.server.index') }}" class="btn btn-sm btn-soft-teal btn-pill btn-elevated">
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
                    </style>

                    <form action="{{ route('admin.server.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_rack">No Rack <span class="required">*</span></label>
                                    <input type="text" class="form-control @error('no_rack') is-invalid @enderror" id="no_rack" name="no_rack" value="{{ old('no_rack') }}" required>
                                    @error('no_rack')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="rack_unit">Rack Unit <span class="required">*</span></label>
                                    <input type="text" class="form-control @error('rack_unit') is-invalid @enderror" id="rack_unit" name="rack_unit" value="{{ old('rack_unit') }}" required>
                                    @error('rack_unit')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="brand">Brand <span class="required">*</span></label>
                                    <input type="text" class="form-control @error('brand') is-invalid @enderror" id="brand" name="brand" value="{{ old('brand') }}" required>
                                    @error('brand')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="model">Model <span class="required">*</span></label>
                                    <input type="text" class="form-control @error('model') is-invalid @enderror" id="model" name="model" value="{{ old('model') }}" required>
                                    @error('model')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="serial_number">Serial Number <span class="required">*</span></label>
                                    <input type="text" class="form-control @error('serial_number') is-invalid @enderror" id="serial_number" name="serial_number" value="{{ old('serial_number') }}" required>
                                    @error('serial_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="application">Aplikasi <span class="required">*</span></label>
                                    <input type="text" class="form-control @error('application') is-invalid @enderror" id="application" name="application" value="{{ old('application') }}" required>
                                    @error('application')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>

                        

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="procurement_date">Tanggal Pengadaan <span class="required">*</span></label>
                                    <input type="date" class="form-control @error('procurement_date') is-invalid @enderror" id="procurement_date" name="procurement_date" value="{{ old('procurement_date') }}" required>
                                    @error('procurement_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="acquition_date">Tanggal Perolehan <span class="required">*</span></label>
                                    <input type="date" class="form-control @error('acquition_date') is-invalid @enderror" id="acquition_date" name="acquition_date" value="{{ old('acquition_date') }}" required>
                                    @error('acquition_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>

                        <!-- Status dan Deskripsi dipindahkan ke bawah tanggal pengadaan & perolehan -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status">Status <span class="required">*</span></label>
                                    <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                                        <option value="" disabled {{ old('status') ? '' : 'selected' }}>Pilih status...</option>
                                        <option value="Aktif" {{ old('status')=='Aktif' ? 'selected' : '' }}>Aktif</option>
                                        <option value="Perbaikan" {{ old('status')=='Perbaikan' ? 'selected' : '' }}>Perbaikan</option>
                                        <option value="Tidak Aktif" {{ old('status')=='Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                                    </select>
                                    @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="description">Deskripsi</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" placeholder="Deskripsi server atau catatan...">{{ old('description') }}</textarea>
                                    @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
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