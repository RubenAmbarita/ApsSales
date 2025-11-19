@extends('layouts.admin')

@section('title', 'Detail Server')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Server</h1>
        <div>
            <a href="{{ route('admin.server.index') }}" class="btn btn-sm btn-soft-teal btn-pill btn-elevated">
                <i class="fas fa-arrow-left fa-sm mr-1"></i> Kembali
            </a>
            <a href="{{ route('admin.server.edit', $item->id) }}" class="btn btn-sm btn-soft-primary btn-pill btn-elevated">
                <i class="fas fa-edit fa-sm mr-1"></i> Edit
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-8 col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Server</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <th style="width: 30%">No Rack</th>
                                    <td>{{ $item->no_rack ?: '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Rack Unit</th>
                                    <td>{{ $item->rack_unit ?: '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Brand</th>
                                    <td>{{ $item->brand ?: '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Model</th>
                                    <td>{{ $item->model ?: '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Serial Number</th>
                                    <td>{{ $item->serial_number ?: '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Aplikasi</th>
                                    <td>{{ $item->application ?: '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        @php
                                            $serverStatus = $item->status ?? null;
                                            $serverStatusLower = $serverStatus ? Str::lower($serverStatus) : null;
                                            $serverStatusClass = 'badge-secondary';
                                            if ($serverStatusLower === 'aktif' || $serverStatusLower === 'active') {
                                                $serverStatusClass = 'badge-success';
                                            } elseif (in_array($serverStatusLower, ['perbaikan','maintenance','maintain','pemeliharaan'])) {
                                                $serverStatusClass = 'badge-warning';
                                            } elseif (in_array($serverStatusLower, ['down','offline','gangguan'])) {
                                                $serverStatusClass = 'badge-danger';
                                            } elseif (in_array($serverStatusLower, ['tidak aktif','inactive','retired','decommissioned','nonaktif'])) {
                                                $serverStatusClass = 'badge-secondary';
                                            }
                                        @endphp
                                        @if($serverStatus)
                                            <span class="badge {{ $serverStatusClass }}">{{ $serverStatus }}</span>
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Tanggal Pengadaan</th>
                                    <td>{{ $item->procurement_date ? $item->procurement_date->format('d F Y') : '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal Perolehan</th>
                                    <td>{{ $item->acquition_date ? $item->acquition_date->format('d F Y') : '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Deskripsi</th>
                                    <td>{{ $item->description ?: '-' }}</td>
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
                    @php
                        $serverStatus = $item->status ?? null;
                        $serverStatusLower = $serverStatus ? Str::lower($serverStatus) : null;
                        $serverStatusClass = 'badge-secondary';
                        if ($serverStatusLower === 'aktif' || $serverStatusLower === 'active') {
                            $serverStatusClass = 'badge-success';
                        } elseif (in_array($serverStatusLower, ['perbaikan','maintenance','maintain','pemeliharaan'])) {
                            $serverStatusClass = 'badge-warning';
                        } elseif (in_array($serverStatusLower, ['down','offline','gangguan'])) {
                            $serverStatusClass = 'badge-danger';
                        } elseif (in_array($serverStatusLower, ['tidak aktif','inactive','retired','decommissioned','nonaktif'])) {
                            $serverStatusClass = 'badge-secondary';
                        }
                    @endphp
                    @if($serverStatus)
                        <span class="badge {{ $serverStatusClass }}">{{ $serverStatus }}</span>
                    @else
                        <span class="badge badge-info">Server</span>
                    @endif
                </div>
                <div class="card-body p-3 summary-card-body">
                    <div class="summary-grid">
                        <div class="summary-item">
                            <div class="summary-icon bg-primary text-white"><i class="fas fa-server"></i></div>
                            <div class="summary-content">
                                <div class="summary-label">No Rack</div>
                                <div class="summary-value">{{ $item->no_rack ?: '-' }}</div>
                            </div>
                        </div>
                        <div class="summary-item">
                            <div class="summary-icon bg-success text-white"><i class="fas fa-layer-group"></i></div>
                            <div class="summary-content">
                                <div class="summary-label">Rack Unit</div>
                                <div class="summary-value">{{ $item->rack_unit ?: '-' }}</div>
                            </div>
                        </div>
                        <div class="summary-item">
                            <div class="summary-icon bg-info text-white"><i class="fas fa-industry"></i></div>
                            <div class="summary-content">
                                <div class="summary-label">Brand / Model</div>
                                <div class="summary-value">{{ trim(($item->brand ?: '-') . ' / ' . ($item->model ?: '-')) }}</div>
                            </div>
                        </div>
                        <div class="summary-item">
                            <div class="summary-icon bg-secondary text-white"><i class="fas fa-circle"></i></div>
                            <div class="summary-content">
                                <div class="summary-label">Status</div>
                                <div class="summary-value">
                                    @if($serverStatus)
                                        <span class="badge {{ $serverStatusClass }}">{{ $serverStatus }}</span>
                                    @else
                                        -
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="summary-item">
                            <div class="summary-icon bg-warning text-white"><i class="fas fa-calendar-alt"></i></div>
                            <div class="summary-content">
                                <div class="summary-label">Pengadaan / Perolehan</div>
                                <div class="summary-value">
                                    {{ $item->procurement_date ? $item->procurement_date->format('d F Y') : '-' }}
                                    /
                                    {{ $item->acquition_date ? $item->acquition_date->format('d F Y') : '-' }}
                                </div>
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
  @media (min-width: 992px) { .summary-grid { grid-template-columns: 1fr; } }
  .summary-item { display: flex; align-items: center; padding: 12px 14px; border: 1px solid #e9ecef; border-radius: 12px; background: #fbfdff; }
  .summary-icon { width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-right: 12px; }
  .summary-label { font-size: 12px; color: #6c757d; margin-bottom: 2px; font-weight: 600; }
  .summary-value { font-size: 14px; font-weight: 600; color: #2c3e50; }
  :root { --teal: #11998e; --teal-soft: rgba(17,153,142,.12); --teal-border: rgba(17,153,142,.30); }
  .btn-pill { border-radius: 999px !important; }
  .btn-elevated { box-shadow: 0 6px 14px rgba(17,24,39,.08); }
  .btn-elevated:hover { box-shadow: 0 8px 18px rgba(17,24,39,.12); }
  .btn-soft-primary { background-color: rgba(78,115,223,.12); color: #3b5ddd; border: 1px solid rgba(78,115,223,.30); }
  .btn-soft-primary:hover { background-color: rgba(78,115,223,.20); color: #2e51d1; }
  .btn-soft-teal { background-color: var(--teal-soft); color: var(--teal); border: 1px solid var(--teal-border); }
  .btn-soft-teal:hover { background-color: rgba(17,153,142,.20); color: #0f8279; }
</style>
@endsection