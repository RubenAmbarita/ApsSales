@extends('layouts.admin')

@section('title', 'Detail Jadwal Perawatan')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Jadwal Perawatan</h1>
        <div>
            <a href="{{ route('admin.riwayatperawatan.index') }}" class="btn btn-sm btn-soft-teal btn-pill btn-elevated">
                <i class="fas fa-arrow-left fa-sm mr-1"></i> Kembali
            </a>
            <a href="{{ route('admin.riwayatperawatan.edit', $item->id) }}" class="btn btn-sm btn-soft-primary btn-pill btn-elevated">
                <i class="fas fa-edit fa-sm mr-1"></i> Edit
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-8 col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Perawatan</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <th style="width: 30%">Server</th>
                                    <td>
                                        @if($item->server)
                                            {{ $item->server->brand }} {{ $item->server->model }}
                                            @if($item->server->serial_number)
                                                <span class="text-muted">(SN {{ $item->server->serial_number }})</span>
                                            @endif
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Tanggal Perawatan</th>
                                    <td>{{ \Carbon\Carbon::parse($item->treatment_date)->locale('id')->translatedFormat('d F Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Tipe Perawatan</th>
                                    <td>{{ $item->treatment_type }}</td>
                                </tr>
                                <tr>
                                    <th>Deskripsi</th>
                                    <td>{{ $item->description ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Biaya</th>
                                    <td>{{ $item->cost !== null ? 'Rp '.number_format((float) $item->cost, 0, ',', '.') : '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Masa Garansi</th>
                                    <td>{{ $item->long_warranty ?? '-' }}</td>
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
                    <span class="badge badge-info">Perawatan</span>
                </div>
                <div class="card-body p-3 summary-card-body">
                    <div class="summary-grid">
                        <div class="summary-item">
                            <div class="summary-icon bg-primary text-white"><i class="fas fa-server"></i></div>
                            <div class="summary-content">
                                <div class="summary-label">Server</div>
                                <div class="summary-value">
                                    @if($item->server)
                                        {{ $item->server->brand }} {{ $item->server->model }}
                                    @else
                                        -
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="summary-item">
                            <div class="summary-icon bg-warning text-white"><i class="fas fa-calendar-alt"></i></div>
                            <div class="summary-content">
                                <div class="summary-label">Tanggal Perawatan</div>
                                <div class="summary-value">{{ \Carbon\Carbon::parse($item->treatment_date)->locale('id')->translatedFormat('d F Y') }}</div>
                            </div>
                        </div>
                        <div class="summary-item">
                            <div class="summary-icon bg-success text-white"><i class="fas fa-money-bill-wave"></i></div>
                            <div class="summary-content">
                                <div class="summary-label">Biaya</div>
                                <div class="summary-value">{{ $item->cost !== null ? 'Rp '.number_format((float) $item->cost, 0, ',', '.') : '-' }}</div>
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
  .summary-item { display: flex; align-items: center; padding: 12px 14px; border: 1px solid #e9ecef; border-radius: 12px; background: #fbfdff; }
  .summary-icon { width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-right: 12px; }
  .summary-label { font-size: 12px; color: #6c757d; margin-bottom: 2px; font-weight: 600; }
  .summary-value { font-size: 14px; font-weight: 600; color: #2c3e50; }
</style>
@endsection