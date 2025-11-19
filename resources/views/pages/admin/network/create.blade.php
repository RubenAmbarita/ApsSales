@extends('layouts.admin')

@section('title', 'Tambah Perangkat Jaringan')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Perangkat Jaringan</h1>
        <a href="{{ route('admin.network.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-soft-teal btn-pill btn-elevated">
            <i class="fas fa-arrow-left fa-sm mr-1"></i> Kembali
        </a>
    </div>

    <!-- Form -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Tambah Perangkat Jaringan</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.network.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="brand">Brand <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('brand') is-invalid @enderror" id="brand" name="brand" value="{{ old('brand') }}" required>
                            @error('brand')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="production_year">Tahun Produksi <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('production_year') is-invalid @enderror" id="production_year" name="production_year" value="{{ old('production_year') }}" required>
                            @error('production_year')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="function">Fungsi <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('function') is-invalid @enderror" id="function" name="function" value="{{ old('function') }}" required>
                            @error('function')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="serial_number">Serial Number <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('serial_number') is-invalid @enderror" id="serial_number" name="serial_number" value="{{ old('serial_number') }}" required>
                            @error('serial_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="id_location">Lokasi <span class="text-danger">*</span></label>
                            <select class="form-control @error('id_location') is-invalid @enderror" id="id_location" name="id_location" required>
                                <option value="">Pilih Lokasi</option>
                                @foreach($locations as $location)
                                <option value="{{ $location->id }}" {{ old('id_location') == $location->id ? 'selected' : '' }}>
                                    {{ $location->name }} - {{ $location->room }} (Lantai {{ $location->floor }})
                                </option>
                                @endforeach
                            </select>
                            @error('id_location')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="id_vendor">Vendor <span class="text-danger">*</span></label>
                            <select class="form-control @error('id_vendor') is-invalid @enderror" id="id_vendor" name="id_vendor" required>
                                <option value="">Pilih Vendor</option>
                                @foreach($vendors as $vendor)
                                <option value="{{ $vendor->id }}" {{ old('id_vendor') == $vendor->id ? 'selected' : '' }}>
                                    {{ $vendor->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('id_vendor')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="status">Status <span class="text-danger">*</span></label>
                            <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="">Pilih Status</option>
                                <option value="Active" {{ old('status') == 'Active' ? 'selected' : '' }}>Aktif</option>
                                <option value="Inactive" {{ old('status') == 'Inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                                <option value="Maintenance" {{ old('status') == 'Maintenance' ? 'selected' : '' }}>Maintenance</option>
                            </select>
                            @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="eosale_date">End of Sale Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('eosale_date') is-invalid @enderror" id="eosale_date" name="eosale_date" value="{{ old('eosale_date') }}" required>
                            @error('eosale_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="eosupport_date">End of Support Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('eosupport_date') is-invalid @enderror" id="eosupport_date" name="eosupport_date" value="{{ old('eosupport_date') }}" required>
                            @error('eosupport_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="description">Deskripsi</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4">{{ old('description') }}</textarea>
                            @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="d-flex justify-content-end align-items-center mt-3">
                    <button type="submit" class="btn btn-soft-primary btn-pill btn-elevated">
                        <i class="fas fa-save mr-1"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection