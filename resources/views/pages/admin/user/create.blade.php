@extends('layouts.admin')
@section('title', 'Tambah User')

@section('content')
    <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Tambah User</h1>
                        <a href="{{ route('admin.user.index') }}" class="btn btn-sm btn-soft-teal btn-pill btn-elevated">
                            <i class="fas fa-arrow-left fa-sm mr-1"></i> Kembali
                        </a>
                    </div>

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>

                    @endif

                    <div class="card shadow mb-4 card-soft">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Form Tambah User</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.user.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Nama User <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                                            @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">Email <span class="text-danger">*</span></label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                                            @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nip">NIP</label>
                                            <input type="text" class="form-control @error('nip') is-invalid @enderror" id="nip" name="nip" value="{{ old('nip') }}">
                                            @error('nip')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="roles">Roles <span class="text-danger">*</span></label>
                                            <select name="roles" id="roles" class="form-control @error('roles') is-invalid @enderror" required>
                                                <option value="">-- Pilih Role --</option>
                                                <option value="ADMIN" {{ old('roles')=='ADMIN' ? 'selected' : '' }}>Admin</option>
                                                <option value="KATIMJA" {{ old('roles')=='KATIMJA' ? 'selected' : '' }}>Katimja</option>
                                                <option value="STAFF" {{ old('roles')=='STAFF' ? 'selected' : '' }}>Staff</option>
                                            </select>
                                            @error('roles')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <!-- Departemen & Password (Kanan-Kiri) -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="id_department">Departemen <span class="text-danger">*</span></label>
                                            <select name="id_department" id="id_department" class="form-control @error('id_department') is-invalid @enderror" required>
                                                <option value="">-- Pilih Departemen --</option>
                                                @foreach($departemens as $dept)
                                                    <option value="{{ $dept->id }}" {{ old('id_department') == $dept->id ? 'selected' : '' }}>{{ $dept->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('id_department')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password">Password <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-secondary toggle-password" type="button" data-target="#password" aria-label="Toggle password visibility">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </div>
                                                @error('password')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-soft-primary btn-pill btn-elevated btn-block">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
@endsection