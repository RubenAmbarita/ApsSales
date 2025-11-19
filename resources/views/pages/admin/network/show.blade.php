@extends('layouts.admin')

@section('title', 'Detail Perangkat Jaringan')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Perangkat Jaringan</h1>
        <div>
            <a href="{{ route('admin.network.index') }}" class="btn btn-sm btn-soft-teal btn-pill btn-elevated">
                <i class="fas fa-arrow-left fa-sm mr-1"></i> Kembali
            </a>
            <a href="{{ route('admin.network.edit', $network->id) }}" class="btn btn-sm btn-soft-primary btn-pill btn-elevated ml-2">
                <i class="fas fa-edit fa-sm mr-1"></i> Edit
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-8 col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Perangkat</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <th style="width: 30%">Brand</th>
                                    <td>{{ $network->brand }}</td>
                                </tr>
                                <tr>
                                    <th>Fungsi</th>
                                    <td>{{ $network->function }}</td>
                                </tr>
                                <tr>
                                    <th>Tahun Produksi</th>
                                    <td>{{ $network->production_year }}</td>
                                </tr>
                                <tr>
                                    <th>Serial Number</th>
                                    <td>{{ $network->serial_number }}</td>
                                </tr>
                                <tr>
                                    <th>Lokasi</th>
                                    <td>{{ $network->location->name ?? 'N/A' }} - {{ $network->location->room ?? 'N/A' }} (Lantai {{ $network->location->floor ?? 'N/A' }})</td>
                                </tr>
                                <tr>
                                    <th>Vendor</th>
                                    <td>{{ $network->vendor->name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>End of Sale</th>
                                    <td>{{ $network->eosale_date ? \Carbon\Carbon::parse($network->eosale_date)->format('d-m-Y') : '-' }}</td>
                                </tr>
                                <tr>
                                    <th>End of Support</th>
                                    <td>{{ $network->eosupport_date ? \Carbon\Carbon::parse($network->eosupport_date)->format('d-m-Y') : '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        @php($statusMap = ['Active' => 'Aktif', 'Inactive' => 'Tidak Aktif', 'Maintenance' => 'Maintenance'])
                                        @php($statusClass = $network->status === 'Active' ? 'badge-success' : ($network->status === 'Inactive' ? 'badge-danger' : ($network->status === 'Maintenance' ? 'badge-warning' : 'badge-secondary')))
                                        <span class="badge {{ $statusClass }}">{{ $statusMap[$network->status] ?? $network->status }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Deskripsi</th>
                                    <td>{{ $network->description }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4">
            <div class="card shadow mb-4 summary-card">
                <div class="card-header py-3 d-flex align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-info-circle text-primary mr-2"></i> Ringkasan</h6>
                    @php($statusClass = $network->status === 'Active' ? 'badge-success' : ($network->status === 'Inactive' ? 'badge-danger' : ($network->status === 'Maintenance' ? 'badge-warning' : 'badge-secondary')))
                    @php($statusMap = ['Active' => 'Aktif', 'Inactive' => 'Tidak Aktif', 'Maintenance' => 'Maintenance'])
                    <span class="badge {{ $statusClass }}">{{ $statusMap[$network->status] ?? $network->status }}</span>
                </div>
                <div class="card-body p-3 summary-card-body">
                    <div class="summary-grid">
                        <div class="summary-item">
                            <div class="summary-icon bg-primary text-white"><i class="fas fa-microchip"></i></div>
                            <div class="summary-content">
                                <div class="summary-label">Brand</div>
                                <div class="summary-value">{{ $network->brand }}</div>
                            </div>
                        </div>
                        <div class="summary-item">
                            <div class="summary-icon bg-success text-white"><i class="fas fa-building"></i></div>
                            <div class="summary-content">
                                <div class="summary-label">Vendor</div>
                                <div class="summary-value">{{ $network->vendor->name ?? '-' }}</div>
                            </div>
                        </div>
                        <div class="summary-item">
                            <div class="summary-icon bg-info text-white"><i class="fas fa-map-marker-alt"></i></div>
                            <div class="summary-content">
                                <div class="summary-label">Lokasi</div>
                                <div class="summary-value">{{ $network->location->name ?? 'N/A' }} - {{ $network->location->room ?? 'N/A' }} (Lt. {{ $network->location->floor ?? 'N/A' }})</div>
                            </div>
                        </div>
                        <div class="summary-item">
                            <div class="summary-icon bg-warning text-white"><i class="fas fa-calendar-alt"></i></div>
                            <div class="summary-content">
                                <div class="summary-label">End of Support</div>
                                <div class="summary-value">{{ $network->eosupport_date ? \Carbon\Carbon::parse($network->eosupport_date)->format('d-m-Y') : '-' }}</div>
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
  /* Summary card styling (disamakan dengan Lisensi) */
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