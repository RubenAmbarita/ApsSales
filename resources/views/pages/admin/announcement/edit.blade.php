@extends('layouts.admin')

@section('title', 'Edit Pengumuman')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Pengumuman</h1>
        <a href="{{ route('admin.announcement.index') }}" class="btn btn-sm btn-soft-teal btn-pill btn-elevated">
            <i class="fas fa-arrow-left fa-sm mr-1"></i> Kembali
        </a>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card mb-4 card-soft">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Edit Pengumuman</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.announcement.update', $announcement->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="title">Judul <span class="text-danger">*</span></label>
                                    <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" required value="{{ old('title', $announcement->title) }}">
                                    @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="content">Isi <span class="text-danger">*</span></label>
                                    <textarea id="content" name="content" class="form-control @error('content') is-invalid @enderror" rows="5" required>{{ old('content', $announcement->content) }}</textarea>
                                    @error('content')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="start_date">Tanggal Mulai</label>
                                    <input type="date" id="start_date" name="start_date" class="form-control @error('start_date') is-invalid @enderror" value="{{ old('start_date', optional($announcement->start_date)->format('Y-m-d')) }}">
                                    @error('start_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="end_date">Tanggal Selesai</label>
                                    <input type="date" id="end_date" name="end_date" class="form-control @error('end_date') is-invalid @enderror" value="{{ old('end_date', optional($announcement->end_date)->format('Y-m-d')) }}">
                                    @error('end_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="priority">Prioritas</label>
                                    <select id="priority" name="priority" class="form-control @error('priority') is-invalid @enderror">
                                        <option value="low" {{ old('priority', $announcement->priority)=='low'?'selected':'' }}>Low</option>
                                        <option value="medium" {{ old('priority', $announcement->priority)=='medium'?'selected':'' }}>Medium</option>
                                        <option value="high" {{ old('priority', $announcement->priority)=='high'?'selected':'' }}>High</option>
                                    </select>
                                    @error('priority')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-check">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" name="is_active" value="1" class="form-check-input @error('is_active') is-invalid @enderror" id="is_active" {{ old('is_active', $announcement->is_active) ? 'checked' : '' }}>
                            <label for="is_active" class="form-check-label">Aktif</label>
                            @error('is_active')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <button type="submit" class="btn btn-soft-primary btn-pill btn-elevated btn-block">Ubah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection