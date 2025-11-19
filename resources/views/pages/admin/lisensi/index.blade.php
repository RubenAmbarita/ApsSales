@extends('layouts.admin')

@section('title', 'Lisensi Aplikasi')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Lisensi Aplikasi</h1>
        <!-- Dropdown Ekspor dipindahkan ke dalam card header agar berdampingan dengan tombol Tambah -->
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Filter Bar dipindahkan ke luar card daftar lisensi -->
    <div id="filterSurface" class="filter-surface mb-3">
        <div class="row gx-2 gy-2 align-items-end">
            <div class="col-md-4 col-sm-6">
                <label for="filterVendor" class="filter-label"><span class="filter-icon"><i class="fas fa-handshake"></i></span> Nama Vendor</label>
                <select class="form-control" id="filterVendor" data-placeholder="Pilih vendor...">
                    <option value=""></option>
                    @foreach($vendors as $vendor)
                        <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 col-sm-6">
                <label for="filterStatus" class="filter-label"><span class="filter-icon"><i class="fas fa-clipboard-check"></i></span> Status</label>
                <select class="form-control" id="filterStatus" data-placeholder="Semua Status">
                    <option value="">Semua Status</option>
                    <option value="Aktif">Aktif</option>
                    <option value="Kadaluarsa">Kadaluarsa</option>
                    <option value="Nonaktif">Nonaktif</option>
                </select>
            </div>
            <!-- Tombol Terapkan & Reset dihapus: data auto-reload saat dropdown berubah -->
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Lisensi</h6>
            <div class="header-actions d-flex align-items-center">
                @if(Auth::user()->roles !== 'STAFF')
                <a href="{{ route('admin.lisensi.create') }}" class="btn btn-sm btn-soft-primary btn-pill btn-elevated mr-2">
                    <i class="fas fa-plus mr-1"></i> Tambah
                </a>
                @endif
                <div class="dropdown">
                    <a class="btn btn-sm btn-soft-teal btn-pill btn-elevated dropdown-toggle" href="#" role="button" id="lisensiExportMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-file-export mr-1"></i> Ekspor
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in export-menu" aria-labelledby="lisensiExportMenu">
                        <div class="export-menu__header">
                            <div class="export-menu__title">Pilih Format</div>
                        </div>
                        <a class="dropdown-item export-item" href="#" id="btn-lisensi-export-excel">
                            <span class="export-item__icon bg-soft-success"><i class="fas fa-file-excel"></i></span>
                            <span class="export-item__text">
                                <strong>Export Excel</strong>
                                <small class="text-muted d-block">Format .xlsx</small>
                            </span>
                        </a>
                        <a class="dropdown-item export-item" href="#" id="btn-lisensi-export-pdf">
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
            <!-- Hapus filter-toolbar lama dari dalam card-body -->
            <div class="table-responsive soft-table-wrapper">
                <table class="table table-hover align-middle soft-table" id="tableLisensi" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Vendor</th>
                            <th>Nama Software</th>
                            <th>Fungsi</th>
                            <th>Masa Berlaku</th>
                            <th>Status</th>
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
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    :root {
        --soft-border: #e9edf5;
        --soft-muted: #6b7280; /* Gray-500 */
        --primary: #4e73df; /* SB Admin primary */
        --teal: #11998e;
        --teal-soft: rgba(17,153,142,.12);
        --teal-border: rgba(17,153,142,.3);
    }

    /* Surface filter di luar card */
    .filter-surface {
        background: #ffffff;
        border: 1px solid var(--soft-border);
        border-radius: 12px;
        padding: 12px 16px;
        box-shadow: 0 6px 16px rgba(17, 24, 39, 0.06);
    }

    .filter-label { font-weight: 600; color: #374151; font-size: .9rem; }
    .filter-label .filter-icon { display: inline-flex; align-items: center; justify-content: center; width: 24px; height: 24px; border-radius: 50%; background-color: rgba(78,115,223,.12); color: #4e73df; margin-right: .5rem; }
    .filter-label .filter-icon i { font-size: .85rem; }

    /* Actions styling */
    .btn-pill { border-radius: 999px !important; }
    .btn-elevated { box-shadow: 0 6px 14px rgba(17,24,39,.08); }
    .btn-elevated:hover { box-shadow: 0 8px 18px rgba(17,24,39,.12); }

    .btn-soft-primary { background-color: rgba(78,115,223,.12); color: #3b5ddd; border: 1px solid rgba(78,115,223,.3); }
    .btn-soft-primary:hover { background-color: rgba(78,115,223,.2); color: #2e51d1; }

    .btn-soft-teal { background-color: var(--teal-soft); color: var(--teal); border: 1px solid var(--teal-border); }
    .btn-soft-teal:hover { background-color: rgba(17,153,142,.2); color: #0f8279; }

    /* Select2 base */
    .select2-container { width: 100% !important; }

    /* Nicer pill selection */
    .s2-selection.select2-selection--single {
        height: 2.75rem; /* lebih tinggi agar tidak "gepeng" */
        border-radius: 999px !important;
        border: 1px solid var(--soft-border);
        background-color: #f9fafb;
        padding-left: .75rem;
    }
    .s2-selection .select2-selection__rendered { line-height: 2.75rem !important; color: #111827; }
    .s2-selection .select2-selection__placeholder { color: var(--soft-muted); }
    .s2-selection .select2-selection__arrow { height: 2.75rem !important; }
    .select2-container--default .s2-selection:hover { border-color: #dfe6f3; }
    .select2-container--default.select2-container--open .s2-selection {
        border-color: var(--primary);
        box-shadow: 0 0 0 .14rem rgba(78,115,223,.15);
    }

    /* Dropdown styling & width obey parent column */
    .s2-dropdown.select2-dropdown {
        border: 1px solid var(--soft-border);
        border-radius: 12px;
        box-shadow: 0 10px 24px rgba(17,24,39,0.12);
        min-width: 100%; /* sama dengan lebar kolom/select */
    }
    .s2-dropdown .select2-search--dropdown .select2-search__field {
        border-radius: 8px;
        border: 1px solid var(--soft-border);
        padding: .4rem .6rem;
    }
    .s2-dropdown .select2-results__options { max-height: 260px; }
    .s2-dropdown .select2-results__option { padding: .5rem .75rem; }
    .s2-dropdown .select2-results__option--highlighted { background-color: var(--primary); color: #fff; }

    /* Status badge: cantik & soft */
    .status-badge { display: inline-flex; align-items: center; gap: .35rem; padding: .35rem .6rem; font-weight: 600; border: 1px solid transparent; }
    .badge-soft-success { color: #0b7c3e; background-color: #e9f7ef; border-color: #cdeedb; }
    .badge-soft-danger { color: #b91c1c; background-color: #fdeaea; border-color: #f5caca; }
    .badge-soft-secondary { color: #374151; background-color: #eef2f7; border-color: #dfe6f3; }
    .badge-soft-info { color: #0c4a6e; background-color: #e0f2fe; border-color: #b9e6ff; }

    /* Export menu styling */
    .export-menu { width: 280px; padding: 0; }
    .export-menu__header { display: flex; align-items: center; gap: .6rem; padding: .75rem .85rem; border-bottom: 1px solid var(--soft-border); background-color: #f8fafc; }
    .export-menu__icon { width: 28px; height: 28px; border-radius: 50%; background-color: rgba(17,153,142,.12); color: var(--teal); display: inline-flex; align-items: center; justify-content: center; }
    .export-menu__title { font-weight: 700; color: #111827; }
    .export-menu__subtitle { font-size: .75rem; color: var(--soft-muted); }

    .export-item { display: flex; align-items: center; gap: .6rem; padding: .6rem .85rem; }
    .export-item:hover { background-color: #f3f4f6; }
    .export-item__icon { width: 32px; height: 32px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; }

    .bg-soft-success { background-color: #e9f7ef; color: #0b7c3e; }
    .bg-soft-danger { background-color: #fdeaea; color: #b91c1c; }

    /* Rapikan aksi di tabel agar tidak menumpuk */
    #tableLisensi td.dt-actions { white-space: nowrap; }
    #tableLisensi td.dt-actions .btn { margin-right: .25rem; margin-bottom: 0; }

    /* Responsif padding untuk filter bar */
    @media (max-width: 767.98px) {
        .filter-surface { padding: 10px; }
    }
    /* DataTables toolbar: responsive & cantik */
    .dt-toolbar { gap: .5rem; }
     #tableLisensi_wrapper .dt-toolbar { padding: 6px 8px; margin: .25rem 0 .5rem; }
     #tableLisensi_wrapper .dt-footer { padding: 6px 8px; }
     .dt-toolbar .dt-length, .dt-toolbar .dt-search { display: flex; align-items: center; }
     .dataTables_wrapper .dataTables_length label { display: inline-block; margin: 0; font-weight: 600; color: #374151; white-space: nowrap; }
     .dataTables_wrapper .dataTables_filter label { display: flex; align-items: center; gap: .5rem; margin: 0; font-weight: 600; color: #374151; }
     .dataTables_wrapper .dataTables_length select { border-radius: 999px; border: 1px solid var(--soft-border); background-color: #f9fafb; padding: .35rem .75rem; }
     .dataTables_wrapper .dataTables_filter input { border-radius: 999px; border: 1px solid var(--soft-border); background-color: #f9fafb; padding: .35rem .75rem; min-width: 260px; }
     .dataTables_wrapper .dataTables_filter input:focus,
     .dataTables_wrapper .dataTables_length select:focus { box-shadow: 0 0 0 .14rem rgba(78,115,223,.15); border-color: var(--primary); }
     .dt-footer { gap: .5rem; }
     .dataTables_wrapper .dataTables_info { color: var(--soft-muted); }
     .dataTables_wrapper .dataTables_paginate .pagination { margin: 0; }

    @media (max-width: 767.98px) {
        .dt-toolbar { flex-direction: column; }
        .dataTables_wrapper .dataTables_filter input { width: 100%; min-width: unset; }
        .dataTables_wrapper .dataTables_length { width: 100%; }
    }

    /* Table aesthetic theme */
    .table-responsive { border: 1px solid var(--soft-border); border-radius: 12px; box-shadow: 0 10px 24px rgba(17,24,39,0.08); padding: 8px 12px 12px; }
     #tableLisensi { border-collapse: separate; border-spacing: 0; }
    #tableLisensi thead th { background: linear-gradient(180deg, rgba(78,115,223,.14), rgba(78,115,223,.06)); color: #0f172a; border-bottom: 2px solid var(--soft-border); }
    #tableLisensi tbody tr:nth-child(odd) { background-color: #fbfdff; }
    #tableLisensi tbody tr:nth-child(even) { background-color: #f8fbff; }
    #tableLisensi tbody tr:hover { background-color: #eef4ff; }
    #tableLisensi td { border-color: var(--soft-border); }
</style>
@endpush

@push('addon-script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush