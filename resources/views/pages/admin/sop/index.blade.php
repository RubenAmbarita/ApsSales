@extends('layouts.admin')

@section('title', 'SOP')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">SOP</h1>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Daftar SOP</h6>
            <div class="header-actions d-flex align-items-center">
                @if(Auth::user()->roles !== 'STAFF')
                <a href="{{ route('admin.sop.create') }}" class="btn btn-sm btn-soft-primary btn-pill btn-elevated mr-2">
                    <i class="fas fa-plus mr-1"></i> Tambah
                </a>
                @endif
                <div class="dropdown">
                    <a class="btn btn-sm btn-soft-teal btn-pill btn-elevated dropdown-toggle" href="#" role="button" id="sopExportMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-file-export mr-1"></i> Ekspor
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in export-menu" aria-labelledby="sopExportMenu">
                        <div class="export-menu__header">
                            <div class="export-menu__title">Pilih Format</div>
                        </div>
                        <a class="dropdown-item export-item" href="#" id="btn-sop-export-excel">
                            <span class="export-item__icon bg-soft-success"><i class="fas fa-file-excel"></i></span>
                            <span class="export-item__text">
                                <strong>Export Excel</strong>
                                <small class="text-muted d-block">Format .xlsx</small>
                            </span>
                        </a>
                        <a class="dropdown-item export-item" href="#" id="btn-sop-export-pdf">
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
                <table class="table table-hover align-middle soft-table" id="tableSop" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No SOP</th>
                            <th>Nama SOP</th>
                            <th>Versi</th>
                            <th>Pemilik</th>
                            <th>Tanggal Berlaku</th>
                            <th>Disetujui Oleh</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('addon-style')
<style>
    :root {
        --soft-border: #e9edf5;
        --soft-muted: #6b7280;
        --primary: #4e73df;
        --teal: #11998e;
        --teal-soft: rgba(17,153,142,.12);
        --teal-border: rgba(17,153,142,.3);
    }

    .btn-pill { border-radius: 999px !important; }
    .btn-elevated { box-shadow: 0 6px 14px rgba(17,24,39,.08); }
    .btn-elevated:hover { box-shadow: 0 8px 18px rgba(17,24,39,.12); }
    .btn-soft-primary { background-color: rgba(78,115,223,.12); color: #3b5ddd; border: 1px solid rgba(78,115,223,.3); }
    .btn-soft-primary:hover { background-color: rgba(78,115,223,.2); color: #2e51d1; }
    .btn-soft-teal { background-color: var(--teal-soft); color: var(--teal); border: 1px solid var(--teal-border); }
    .btn-soft-teal:hover { background-color: rgba(17,153,142,.2); color: #0f8279; }

    .export-menu { width: 280px; padding: 0; }
    .export-menu__header { display: flex; align-items: center; gap: .6rem; padding: .75rem .85rem; border-bottom: 1px solid var(--soft-border); background-color: #f8fafc; }
    .export-item { display: flex; align-items: center; gap: .6rem; padding: .6rem .85rem; }
    .export-item:hover { background-color: #f3f4f6; }
    .export-item__icon { width: 32px; height: 32px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; }
    .bg-soft-success { background-color: #e9f7ef; color: #0b7c3e; }
    .bg-soft-danger { background-color: #fdeaea; color: #b91c1c; }

    .table-responsive { border: 1px solid var(--soft-border); border-radius: 12px; box-shadow: 0 10px 24px rgba(17,24,39,0.08); padding: 8px 12px 12px; }
    #tableSop { border-collapse: separate; border-spacing: 0; }
    #tableSop thead th { background: linear-gradient(180deg, rgba(78,115,223,.14), rgba(78,115,223,.06)); color: #0f172a; border-bottom: 2px solid var(--soft-border); }
    #tableSop tbody tr:nth-child(odd) { background-color: #fbfdff; }
    #tableSop tbody tr:nth-child(even) { background-color: #f8fbff; }
    #tableSop tbody tr:hover { background-color: #eef4ff; }
    #tableSop td { border-color: var(--soft-border); }
    #tableSop td.dt-actions { white-space: nowrap; }
    #tableSop td.dt-actions .btn { margin-right: .25rem; }
    /* Perkecil kolom "No" (kolom ke-1) */
    #tableSop th:nth-child(1), #tableSop td:nth-child(1) {
        width: 56px !important;
        min-width: 56px !important;
        max-width: 56px !important;
        white-space: nowrap;
        padding-left: 8px;
        padding-right: 8px;
        text-align: center;
    }
    /* Perlebar kolom "Pemilik" (kolom ke-5) */
    #tableSop th:nth-child(5), #tableSop td:nth-child(5) {
        width: 240px !important;
        min-width: 240px !important;
        max-width: 360px !important;
        white-space: normal;
        overflow-wrap: anywhere;
        word-break: normal;
    }
    /* Kecilkan kolom "Versi" (kolom ke-4) */
    /* (rollback) Hapus pengaturan khusus kolom Versi sehingga kembali default */
    /* Besarkan kolom "Nama SOP" (kolom ke-3) */
    /* (rollback) Hapus pengaturan khusus kolom Nama SOP sehingga kembali default */
</style>
@endpush