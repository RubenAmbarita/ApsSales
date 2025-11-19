@extends('layouts.admin')
@section('title', 'Detail Vendor')
@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Vendor</h1>
        <div>
            <a href="{{ route('admin.vendor.index') }}" class="btn btn-sm btn-soft-teal btn-pill btn-elevated">
                <i class="fas fa-arrow-left fa-sm mr-1"></i> Kembali
            </a>
            <a href="{{ route('admin.vendor.edit', $item->id) }}" class="btn btn-sm btn-soft-primary btn-pill btn-elevated">
                <i class="fas fa-pencil-alt fa-sm mr-1"></i> Edit
            </a>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-8 col-lg-8">
            <div class="card shadow mb-4 card-soft">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Vendor</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <th style="width: 30%">Nama Vendor</th>
                                    <td>{{ $item->name }}</td>
                                </tr>
                                <tr>
                                    <th>PIC</th>
                                    <td>{{ $item->pic }}</td>
                                </tr>
                                <tr>
                                    <th>Telepon</th>
                                    <td>{{ $item->telephone }}</td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <td>{{ $item->address }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4">
            <div class="card shadow mb-4 card-soft summary-card">
                <div class="card-header py-3 d-flex align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-info-circle text-primary mr-2"></i> Ringkasan</h6>
                    <span class="badge badge-secondary">Vendor</span>
                </div>
                <div class="card-body p-3 summary-card-body">
                    <div class="summary-grid">
                        <div class="summary-item">
                            <div class="summary-icon bg-info text-white"><i class="fas fa-user-tie"></i></div>
                            <div class="summary-content">
                                <div class="summary-label">PIC</div>
                                <div class="summary-value">{{ $item->pic ?: '-' }}</div>
                            </div>
                        </div>
                        <div class="summary-item">
                            <div class="summary-icon bg-success text-white"><i class="fas fa-phone"></i></div>
                            <div class="summary-content">
                                <div class="summary-label">Telepon</div>
                                <div class="summary-value">{{ $item->telephone ?: '-' }}</div>
                            </div>
                        </div>
                        <div class="summary-item">
                            <div class="summary-icon bg-warning text-white"><i class="fas fa-map-marker-alt"></i></div>
                            <div class="summary-content">
                                <div class="summary-label">Alamat</div>
                                <div class="summary-value">{{ $item->address ?: '-' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<style>
  .summary-card .card-header { background: #f8fafc; border-bottom: 1px solid #e9ecef; }
  .summary-card-body { background: #ffffff; }
  .summary-grid { display: grid; grid-template-columns: 1fr; grid-gap: 12px; }
  @media (min-width: 576px) { .summary-grid { grid-template-columns: 1fr; } }
  @media (min-width: 768px) { .summary-grid { grid-template-columns: 1fr; } }
  @media (min-width: 992px) { .summary-grid { grid-template-columns: 1fr; } }
  .summary-item { display: flex; align-items: center; padding: 12px 14px; border: 1px solid #e9ecef; border-radius: 12px; background: #fbfdff; }
  .summary-icon { width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-right: 12px; box-shadow: inset 0 0 0 1px rgba(255,255,255,0.3); }
  .summary-label { font-size: 12px; color: #6c757d; margin-bottom: 2px; font-weight: 600; letter-spacing: .2px; }
  .summary-value { font-size: 14px; font-weight: 600; color: #2c3e50; }
</style>
@endsection