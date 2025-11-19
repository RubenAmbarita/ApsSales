@extends('layouts.admin')

@section('title', 'Daftar Server')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Server</h1>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Server</h6>
            <div class="header-actions d-flex align-items-center">
                @if(Auth::user()->roles !== 'STAFF')
                <a href="{{ route('admin.server.create') }}" class="btn btn-sm btn-soft-primary btn-pill btn-elevated">
                    <i class="fas fa-plus mr-1"></i> Tambah
                </a>
                @endif
                <div class="dropdown ml-2">
                    <a class="btn btn-sm btn-soft-teal btn-pill btn-elevated dropdown-toggle" href="#" role="button" id="serverExportMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-file-export mr-1"></i> Ekspor
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in export-menu" aria-labelledby="serverExportMenu">
                        <div class="export-menu__header">
                            <div class="export-menu__title">Pilih Format</div>
                        </div>
                        <a class="dropdown-item export-item" href="#" id="btn-server-export-excel">
                            <span class="export-item__icon bg-soft-success"><i class="fas fa-file-excel"></i></span>
                            <span class="export-item__text">
                                <strong>Export Excel</strong>
                                <small class="text-muted d-block">Format .xlsx</small>
                            </span>
                        </a>
                        <a class="dropdown-item export-item" href="#" id="btn-server-export-pdf">
                            <span class="export-item__icon bg-soft-danger"><i class="fas fa-file-pdf"></i></span>
                            <span class="export-item__text">
                                <strong>Export PDF</strong>
                                <small class="text-muted d-block">Siap cetak</small>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive soft-table-wrapper">
                <table class="table table-hover align-middle soft-table" id="tableServer" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Rack</th>
                            <th>Rack Unit</th>
                            <th>Brand</th>
                            <th>Model</th>
                            <th>Serial Number</th>
                            <th>Aplikasi</th>
                            <th>Status</th>
                            <th>Tgl Pengadaan</th>
                            <th>Tgl Perolehan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('addon-style')
<style>
    :root { --soft-border: #e9edf5; --soft-muted: #6b7280; --primary: #4e73df; }
    .btn-pill { border-radius: 999px !important; }
    .btn-elevated { box-shadow: 0 6px 14px rgba(17,24,39,.08); }
    .btn-elevated:hover { box-shadow: 0 8px 18px rgba(17,24,39,.12); }
    .btn-soft-primary { background-color: rgba(78,115,223,.12); color: #3b5ddd; border: 1px solid rgba(78,115,223,.3); }
    .btn-soft-primary:hover { background-color: rgba(78,115,223,.2); color: #2e51d1; }
    .table-responsive { border: 1px solid var(--soft-border); border-radius: 12px; box-shadow: 0 10px 24px rgba(17,24,39,0.08); padding: 8px 12px 12px; }
    #tableServer { border-collapse: separate; border-spacing: 0; }
    #tableServer thead th { background: linear-gradient(180deg, rgba(78,115,223,.14), rgba(78,115,223,.06)); color: #0f172a; border-bottom: 2px solid var(--soft-border); }
    #tableServer tbody tr:nth-child(odd) { background-color: #fbfdff; }
    #tableServer tbody tr:nth-child(even) { background-color: #f8fbff; }
    #tableServer tbody tr:hover { background-color: #eef4ff; }
    #tableServer td { border-color: var(--soft-border); }
    #tableServer td.dt-actions { white-space: nowrap; }
    #tableServer td.dt-actions .btn { margin-right: .25rem; margin-bottom: 0; }
</style>
@endpush