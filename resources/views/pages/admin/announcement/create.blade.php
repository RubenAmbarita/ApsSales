@extends('layouts.admin')

@section('title', 'Tambah Pengumuman')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Tambah Pengumuman</h1>
        </div>
        <a href="{{ route('admin.announcement.index') }}" class="btn btn-sm btn-soft-teal btn-pill btn-elevated">
            <i class="fas fa-arrow-left fa-sm mr-1"></i> Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4 card-soft">
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <strong>Terjadi kesalahan saat menyimpan.</strong>
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
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
                    </style>

                    <form method="POST" action="{{ route('admin.announcement.store') }}">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Judul <span class="required">*</span></label>
                                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" required value="{{ old('title') }}" placeholder="Judul pengumuman">
                                    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Prioritas</label>
                                    <select name="priority" class="form-control @error('priority') is-invalid @enderror">
                                        <option value="low" {{ old('priority')=='low'?'selected':'' }}>Low</option>
                                        <option value="medium" {{ old('priority','medium')=='medium'?'selected':'' }}>Medium</option>
                                        <option value="high" {{ old('priority')=='high'?'selected':'' }}>High</option>
                                    </select>
                                    <small class="help-text">Pilih tingkat prioritas pengumuman.</small>
                                    @error('priority')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Mulai</label>
                                    <input type="date" name="start_date" class="form-control @error('start_date') is-invalid @enderror" value="{{ old('start_date') }}">
                                    <small class="help-text">Tanggal mulai berlaku pengumuman.</small>
                                    @error('start_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Selesai</label>
                                    <input type="date" name="end_date" class="form-control @error('end_date') is-invalid @enderror" value="{{ old('end_date') }}">
                                    <small class="help-text">Opsional, tanggal berakhir pengumuman.</small>
                                    @error('end_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Isi <span class="required">*</span></label>
                                    <textarea name="content" class="form-control @error('content') is-invalid @enderror" rows="6" required placeholder="Teks pengumuman">{{ old('content') }}</textarea>
                                    @error('content')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group form-check">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" name="is_active" value="1" class="form-check-input @error('is_active') is-invalid @enderror" id="is_active" {{ old('is_active') ? 'checked' : '' }}>
                            <label for="is_active" class="form-check-label">Aktif</label>
                            @error('is_active')<div class="invalid-feedback">{{ $message }}</div>@enderror
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