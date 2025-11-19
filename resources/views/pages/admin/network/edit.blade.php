@extends('layouts.admin')

@section('title', 'Edit Perangkat Jaringan')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Perangkat Jaringan</h1>
        <a href="{{ route('admin.network.index') }}" class="btn btn-sm btn-soft-teal btn-pill btn-elevated">
            <i class="fas fa-arrow-left fa-sm mr-1"></i> Kembali
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Edit Perangkat Jaringan</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.network.update', $network->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="brand">Brand</label>
                            <input type="text" class="form-control" id="brand" name="brand" value="{{ old('brand', $network->brand) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="production_year">Tahun Produksi</label>
                            <input type="text" class="form-control" id="production_year" name="production_year" value="{{ old('production_year', $network->production_year) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="function">Fungsi</label>
                            <input type="text" class="form-control" id="function" name="function" value="{{ old('function', $network->function) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="serial_number">Serial Number</label>
                            <input type="text" class="form-control" id="serial_number" name="serial_number" value="{{ old('serial_number', $network->serial_number) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="id_location">Lokasi</label>
                            <select class="form-control" id="id_location" name="id_location" required>
                                @foreach($locations as $location)
                                <option value="{{ $location->id }}" {{ $network->id_location == $location->id ? 'selected' : '' }}>
                                    {{ $location->name }} - {{ $location->room }} (Lantai {{ $location->floor }})
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="id_vendor">Vendor</label>
                            <select class="form-control" id="id_vendor" name="id_vendor" required>
                                @foreach($vendors as $vendor)
                                <option value="{{ $vendor->id }}" {{ $network->id_vendor == $vendor->id ? 'selected' : '' }}>
                                    {{ $vendor->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="eosale_date">End of Sale Date</label>
                            <input type="date" class="form-control" id="eosale_date" name="eosale_date" value="{{ old('eosale_date', $network->eosale_date ? $network->eosale_date->format('Y-m-d') : '') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="eosupport_date">End of Support Date</label>
                            <input type="date" class="form-control" id="eosupport_date" name="eosupport_date" value="{{ old('eosupport_date', $network->eosupport_date ? $network->eosupport_date->format('Y-m-d') : '') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="Active" {{ $network->status == 'Active' ? 'selected' : '' }}>Aktif</option>
                                <option value="Inactive" {{ $network->status == 'Inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                                <option value="Maintenance" {{ $network->status == 'Maintenance' ? 'selected' : '' }}>Maintenance</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description">Deskripsi</label>
                            <textarea class="form-control" id="description" name="description" rows="4" required>{{ old('description', $network->description) }}</textarea>
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