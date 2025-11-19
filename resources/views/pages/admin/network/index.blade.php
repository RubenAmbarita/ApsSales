@extends('layouts.admin')

@section('title', 'Perangkat Jaringan')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Perangkat Jaringan</h1>
    </div>

    <!-- Filter Bar: vendor & status (seperti di lisensi) -->
    <div id="filterSurface" class="filter-surface mb-3">
        <div class="row gx-2 gy-2 align-items-end">
            <div class="col-md-4 col-sm-6">
                <label for="filterVendor" class="filter-label"><span class="filter-icon"><i class="fas fa-handshake"></i></span> Nama Vendor</label>
                <select class="form-control" id="filterVendor" data-placeholder="Pilih vendor...">
                    <option value=""></option>
                    @isset($vendors)
                        @foreach($vendors as $vendor)
                            <option value="{{ $vendor->id }}" {{ (isset($filters['vendor_id']) && $filters['vendor_id']==$vendor->id) ? 'selected' : '' }}>{{ $vendor->name }}</option>
                        @endforeach
                    @endisset
                </select>
            </div>
            <div class="col-md-3 col-sm-6">
                <label for="filterStatus" class="filter-label"><span class="filter-icon"><i class="fas fa-clipboard-check"></i></span> Status</label>
                <select class="form-control" id="filterStatus" data-placeholder="Semua Status">
                    @php $currentStatus = $filters['status'] ?? ''; @endphp
                    <option value="" {{ $currentStatus=='' ? 'selected' : '' }}>Semua Status</option>
                    <option value="Active" {{ $currentStatus=='Active' ? 'selected' : '' }}>Aktif</option>
                    <option value="Inactive" {{ $currentStatus=='Inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                    <option value="Maintenance" {{ $currentStatus=='Maintenance' ? 'selected' : '' }}>Maintenance</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Perangkat Jaringan</h6>
            <div class="header-actions d-flex align-items-center">
                @if(Auth::user()->roles !== 'STAFF')
                <a href="{{ route('admin.network.create') }}" class="btn btn-sm btn-soft-primary btn-pill btn-elevated me-2">
                    <i class="fas fa-plus me-1"></i> Tambah
                </a>
                @endif
                <div class="dropdown">
                    <a class="btn btn-sm btn-soft-teal btn-pill btn-elevated dropdown-toggle" href="#" role="button" id="networkExportMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-file-export me-1"></i> Ekspor
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in export-menu" aria-labelledby="networkExportMenu">
                        <div class="export-menu__header">
                            <div class="export-menu__title">Pilih Format</div>
                        </div>
                        <a class="dropdown-item export-item" href="#" id="btn-network-export-excel">
                            <span class="export-item__icon bg-soft-success"><i class="fas fa-file-excel"></i></span>
                            <span class="export-item__text">
                                <strong>Export Excel</strong>
                                <small class="text-muted d-block">Format .xlsx</small>
                            </span>
                        </a>
                        <a class="dropdown-item export-item" href="#" id="btn-network-export-pdf">
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
                <table class="table table-hover align-middle soft-table" id="networkTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Brand</th>
                            <th>Fungsi</th>
                            <th>Lokasi</th>
                            <th>Vendor</th>
                            <th>Serial Number</th>
                            <th>Tahun Produksi</th>
                            <th>End of Sale</th>
                            <th>End of Support</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($networks as $network)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $network->brand }}</td>
                            <td>{{ $network->function }}</td>
                            <td>{{ $network->location->name ?? 'N/A' }}</td>
                            <td>{{ $network->vendor->name ?? 'N/A' }}</td>
                            <td>{{ $network->serial_number }}</td>
                            <td>{{ $network->production_year }}</td>
                            <td>{{ $network->eosale_date ? \Carbon\Carbon::parse($network->eosale_date)->format('d-m-Y') : '' }}</td>
                            <td>{{ $network->eosupport_date ? \Carbon\Carbon::parse($network->eosupport_date)->format('d-m-Y') : '' }}</td>
                            <td>
                                @if($network->status)
                                    @if($network->status == 'Active')
                                    <span class="badge badge-success">Aktif</span>
                                    @elseif($network->status == 'Inactive')
                                    <span class="badge badge-danger">Tidak Aktif</span>
                                    @elseif($network->status == 'Maintenance')
                                    <span class="badge badge-warning">Maintenance</span>
                                    @else
                                    <span class="badge badge-secondary">{{ $network->status }}</span>
                                    @endif
                                @else
                                    
                                @endif
                            </td>
                            <td class="dt-actions text-center">
                                @if(Auth::user()->roles === 'STAFF')
                                    <a href="{{ route('admin.network.show', $network->id) }}" class="btn btn-sm btn-soft-primary btn-pill btn-elevated btn-preview" data-toggle="tooltip" data-placement="top" title="Pratinjau">
                                        <i class="fas fa-eye me-2"></i>
                                        <span class="btn-preview__label d-none d-md-inline">&nbsp;Pratinjau</span>
                                    </a>
                                @else
                                    <a href="{{ route('admin.network.show', $network->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Pratinjau">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.network.edit', $network->id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.network.destroy', $network->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        @csrf
									@method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                        @empty
                        {{-- Biarkan tbody kosong; DataTables akan menampilkan baris .dataTables_empty otomatis --}}
                        @endforelse
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
        :root { --soft-border: #e9edf5; --soft-muted: #6b7280; --primary: #4e73df; }
        .filter-surface { background: #ffffff; border: 1px solid var(--soft-border); border-radius: 12px; padding: 12px 16px; box-shadow: 0 6px 16px rgba(17, 24, 39, 0.06); }
        .filter-label { font-weight: 600; color: #374151; font-size: .9rem; }
        .filter-label .filter-icon { display: inline-flex; align-items: center; justify-content: center; width: 24px; height: 24px; border-radius: 50%; background-color: rgba(78,115,223,.12); color: #4e73df; margin-right: .5rem; }
        .filter-label .filter-icon i { font-size: .85rem; }
        /* Beri jarak antar tombol di header agar tidak terlalu mepet */
        .header-actions { gap: .5rem; }
        .select2-container { width: 100% !important; }
        .s2-selection.select2-selection--single { height: 2.75rem; border-radius: 999px !important; border: 1px solid var(--soft-border); background-color: #f9fafb; padding-left: .75rem; }
        .s2-selection .select2-selection__rendered { line-height: 2.75rem !important; color: #111827; }
        .s2-selection .select2-selection__placeholder { color: var(--soft-muted); }
        .s2-selection .select2-selection__arrow { height: 2.75rem !important; }
    .select2-container--default .s2-selection:hover { border-color: #dfe6f3; }
    .select2-container--default.select2-container--open .s2-selection { border-color: var(--primary); box-shadow: 0 0 0 .14rem rgba(78,115,223,.15); }
    .s2-dropdown.select2-dropdown { border: 1px solid var(--soft-border); border-radius: 12px; box-shadow: 0 10px 24px rgba(17,24,39,0.12); width: 100% !important; min-width: 100% !important; max-width: 100% !important; box-sizing: border-box; }
    .s2-dropdown .select2-search--dropdown .select2-search__field { border-radius: 8px; border: 1px solid var(--soft-border); padding: .4rem .6rem; }
    .s2-dropdown .select2-results__options { max-height: 260px; }
    .s2-dropdown .select2-results__option { padding: .5rem .75rem; }
    .s2-dropdown .select2-results__option--highlighted { background-color: var(--primary); color: #fff; }
    @media (max-width: 767.98px) { .filter-surface { padding: 10px; } }
    /* Rapikan badge status */
    .badge { font-weight: 600; }
    .badge-success { background-color: #e9f7ef; color: #0b7c3e; }
    .badge-danger { background-color: #fdeaea; color: #b91c1c; }
    .badge-warning { background-color: #fff4e5; color: #b45309; }
    .badge-secondary { background-color: #eef2f7; color: #374151; }

    /* Table aesthetic theme — mengikuti halaman Lisensi */
    .table-responsive { border: 1px solid var(--soft-border); border-radius: 12px; box-shadow: 0 10px 24px rgba(17,24,39,0.08); padding: 8px 12px 12px; }
    #networkTable { border-collapse: separate; border-spacing: 0; table-layout: fixed; width: 100%; box-sizing: border-box; }
    #networkTable thead th { background: linear-gradient(180deg, rgba(78,115,223,.14), rgba(78,115,223,.06)); color: #0f172a; border-bottom: 2px solid var(--soft-border); }
    #networkTable tbody tr:nth-child(odd) { background-color: #fbfdff; }
    #networkTable tbody tr:nth-child(even) { background-color: #f8fbff; }
    #networkTable tbody tr:hover { background-color: #eef4ff; }
    /* Responsif: biarkan konten sel membungkus, tapi jaga header agar tidak pecah per huruf */
    #networkTable td { border-color: var(--soft-border) !important; white-space: normal; word-break: break-word; }
    #networkTable th, #networkTable thead th { border-color: var(--soft-border) !important; white-space: nowrap !important; word-break: keep-all !important; }
    #networkTable th:first-child, #networkTable td:first-child { min-width: 56px; text-align: center; }
    #networkTable th:last-child, #networkTable td:last-child { min-width: 110px; }
    /* Tambahkan ruang di dalam sel kolom terakhir agar tombol tidak mepet tepi kanan */
    #networkTable th:last-child, #networkTable td:last-child { padding-right: 18px; }
    /* Rapikan aksi di tabel agar tidak menumpuk — seperti Lisensi */
    #networkTable td.dt-actions { white-space: nowrap; }
    #networkTable td.dt-actions .btn { margin-right: .25rem; margin-bottom: 0; }
    /* Hapus min-width global agar tabel bisa menyesuaikan lebar kontainer (responsif) */
    /* Jika perlu, atur min-width per kolom tertentu saja (No & Aksi diatur di bawah) */
    /* Empty state dikelola oleh DataTables (.dataTables_empty) */

    /* DataTables toolbar & footer — sama seperti Lisensi */
    .dt-toolbar { gap: .5rem; }
    #networkTable_wrapper .dt-toolbar { padding: 6px 8px; margin: .25rem 0 .5rem; }
    #networkTable_wrapper .dt-footer { padding: 6px 8px; }
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
    /* Samakan gutter kanan toolbar dan tabel dengan menghilangkan padding kolom bootstrap di dalam wrapper */
    #networkTable_wrapper > .row { margin-left: 0 !important; margin-right: 0 !important; }
    #networkTable_wrapper > .row > [class^="col-"],
    #networkTable_wrapper > .row > [class*=" col-"] { padding-left: 0 !important; padding-right: 0 !important; }
    /* Tambahkan padding seragam pada toolbar & footer agar sejajar dengan tepi tabel */
    #networkTable_wrapper .dt-toolbar { padding: 6px 12px; }
    #networkTable_wrapper .dt-footer { padding: 6px 12px; }
</style>
@endpush

@push('addon-script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(function(){
        // Init Select2 dengan style pill yang konsisten
        $('#filterVendor').select2({
            theme: 'default',
            width: '100%',
            placeholder: $('#filterVendor').data('placeholder'),
            dropdownCssClass: 's2-dropdown',
            selectionCssClass: 's2-selection',
            dropdownParent: $('#filterVendor').parent(),
            dropdownAutoWidth: false
        });
        $('#filterStatus').select2({
            theme: 'default',
            width: '100%',
            placeholder: $('#filterStatus').data('placeholder'),
            dropdownCssClass: 's2-dropdown',
            selectionCssClass: 's2-selection',
            dropdownParent: $('#filterStatus').parent(),
            dropdownAutoWidth: false
        });

        function applyFilters(){
            const vendor = $('#filterVendor').val() || '';
            const status = $('#filterStatus').val() || '';
            const baseUrl = "{{ route('admin.network.index') }}";
            const params = new URLSearchParams();
            if (vendor) params.set('vendor_id', vendor);
            if (status) params.set('status', status);
            const url = params.toString() ? `${baseUrl}?${params.toString()}` : baseUrl;
            window.location.assign(url);
        }

        $('#filterVendor').on('change', applyFilters);
        $('#filterStatus').on('change', applyFilters);
    });
</script>
@endpush
