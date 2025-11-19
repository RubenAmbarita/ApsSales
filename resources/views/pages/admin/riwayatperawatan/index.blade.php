@extends('layouts.admin')

@section('title', 'Jadwal Perawatan')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0">Jadwal Perawatan</h1>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Filter surface dipisah dan disejajarkan lebarnya dengan card tabel -->
    <div id="filterSurface" class="filter-surface mb-3">
        <div class="row gx-2 gy-2 align-items-end">
            <div class="col-md-5 col-sm-12">
                <label class="filter-label"><span class="filter-icon"><i class="fas fa-calendar-alt"></i></span> Rentang Tanggal</label>
                <div class="d-flex align-items-center gap-2">
                    <input type="date" id="filterStart" class="form-control" />
                    <span class="mx-2">s/d</span>
                    <input type="date" id="filterEnd" class="form-control" />
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <label for="filterStatus" class="filter-label"><span class="filter-icon"><i class="fas fa-clipboard-check"></i></span> Status</label>
                <select id="filterStatus" class="form-control" data-placeholder="Semua Status">
                    <option value="">Semua</option>
                    <option value="Upcoming">Upcoming</option>
                    <option value="Today">Hari Ini</option>
                    <option value="Overdue">Overdue</option>
                </select>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4 card-soft">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Jadwal Perawatan</h6>
            <div class="header-actions d-flex align-items-center">
                @if(Auth::user()->roles !== 'STAFF')
                <a href="{{ route('admin.riwayatperawatan.create') }}" class="btn btn-sm btn-soft-primary btn-pill btn-elevated"><i class="fas fa-plus me-1"></i> Tambah</a>
                @endif
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive soft-table-wrapper">
                <table id="riwayatTable" class="table table-hover align-middle soft-table" style="width:100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th>Server</th>
                            <th>Tanggal Perawatan</th>
                            <th>Tipe</th>
                            <th>Deskripsi</th>
                            <th>Biaya</th>
                            <th>Status</th>
                            <th class="dt-actions text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $i => $item)
                        @php
                            $now = \Carbon\Carbon::today();
                            $date = \Carbon\Carbon::parse($item->treatment_date);
                            $status = $date->isFuture() ? 'Upcoming' : ($date->isToday() ? 'Today' : 'Overdue');
                            $badgeClass = $status === 'Upcoming' ? 'badge-info' : ($status === 'Today' ? 'badge-primary' : 'badge-warning');
                            $daysTo = $date->diffInDays($now, false); // negatif untuk upcoming
                        @endphp
                        <tr>
                            <td class="text-center"></td>
                            <td>
                                {{ optional($item->server)->brand }} {{ optional($item->server)->model }}
                                <div class="small text-muted">SN: {{ optional($item->server)->serial_number }}</div>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($item->treatment_date)->locale('id')->translatedFormat('d F Y') }}</td>
                            <td>{{ $item->treatment_type }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($item->description, 80) }}</td>
                            <td>{{ $item->cost !== null ? 'Rp '.number_format((float) $item->cost, 0, ',', '.') : '-' }}</td>
                            <td>
                                <span class="badge {{ $badgeClass }}">{{ $status }}</span>
                                @if($status === 'Upcoming' && $daysTo >= -7)
                                    <i class="fas fa-bell text-warning ml-1" title="Pengingat: jadwal mendekati"></i>
                                @endif
                            </td>
                            <td class="text-center dt-actions">
                                @if(Auth::user()->roles === 'STAFF')
                                    <a href="{{ route('admin.riwayatperawatan.show', $item->id) }}" class="btn btn-sm btn-soft-primary btn-pill btn-elevated btn-preview" data-toggle="tooltip" data-placement="top" title="Pratinjau">
                                        <i class="fas fa-eye me-2"></i>
                                        <span class="btn-preview__label d-none d-md-inline">&nbsp;Pratinjau</span>
                                    </a>
                                @else
                                    <a href="{{ route('admin.riwayatperawatan.show', $item->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.riwayatperawatan.edit', $item->id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Edit">
                                        <i class="fa fa-pencil-alt"></i>
                                    </a>
                                    <form action="{{ route('admin.riwayatperawatan.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Hapus">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
 </div>
@push('addon-script')
<script>
$(function(){
    var table = $('#riwayatTable').DataTable({
        processing: false,
        serverSide: false,
        responsive: true,
        autoWidth: false,
        stripeClasses: [],
        order: [],
        pageLength: 10,
        lengthMenu: [[10,25,50,100],[10,25,50,100]],
        language: {
            decimal: ",",
            thousands: ".",
            lengthMenu: "Tampilkan _MENU_ data per halaman",
            zeroRecords: "Tidak ada data ditemukan",
            info: "Menampilkan _START_ hingga _END_ dari total _TOTAL_ data",
            infoEmpty: "Menampilkan 0 hingga 0 dari total 0 data",
            infoFiltered: "(difilter dari total _MAX_ data)",
            search: "Cari:",
            loadingRecords: "Sedang memuat...",
            processing: "Sedang memuat...",
            paginate: {
                first: "Pertama",
                last: "Terakhir",
                next: "Berikutnya",
                previous: "Sebelumnya"
            }
        },
        dom: "<'dt-toolbar d-flex flex-wrap align-items-center justify-content-between mb-2'<'dt-left d-flex align-items-center'<'dt-length'l><'dt-buttons ms-2'B>><'dt-right'<'dt-search'f>>>t<'dt-footer d-flex flex-wrap justify-content-between align-items-center mt-2'<'dt-info'i><'dt-pagination'p>>",
        buttons: [
            { extend: 'copy', text: 'Copy' },
            { extend: 'csv', text: 'CSV' },
            { extend: 'excel', text: 'Excel' },
            { extend: 'pdf', text: 'PDF' }
        ],
        columnDefs: [
            { orderable: false, targets: [0,7] },
            { className: 'text-center', targets: [0,6,7] },
            { targets: 7, className: 'text-center text-nowrap dt-actions', width: '140px' }
        ]
    });

    // Placeholder pencarian + ratakan ke kanan agar konsisten dengan halaman Pengumuman
    $('.dataTables_filter input').attr('placeholder','Cari server, tipe, status...').addClass('form-control form-control-sm');
    $('.dataTables_filter').addClass('ms-auto');

    // Penomoran kolom "No" mengikuti pola halaman Pengumuman
    function updateRowNumbers() {
        var info = table.page.info();
        table.column(0, {search:'applied', order:'applied'}).nodes().each(function(cell, i){
            cell.innerHTML = info.start + i + 1;
        });
    }
    // Set nomor awal setelah inisialisasi
    updateRowNumbers();
    // Update nomor setiap kali tabel di-draw (pindah halaman, filter, dll)
    $('#riwayatTable').on('draw.dt', function(){
        updateRowNumbers();
        // Re-init tooltip setiap redraw untuk tombol aksi
        $('[data-toggle="tooltip"]').tooltip();
    });

    // Filter rentang tanggal (kolom tanggal index 2)
    $.fn.dataTable.ext.search.push(function(settings, data){
        if (settings.nTable !== document.getElementById('riwayatTable')) return true;
        var start = $('#filterStart').val();
        var end = $('#filterEnd').val();
        var dateStr = data[2];
        if (!dateStr) return true;
        var months = {
            'Januari':0,'Februari':1,'Maret':2,'April':3,'Mei':4,'Juni':5,
            'Juli':6,'Agustus':7,'September':8,'Oktober':9,'November':10,'Desember':11
        };
        var parts = dateStr.split(' ');
        var d = new Date(parseInt(parts[2],10), months[parts[1]], parseInt(parts[0],10));
        var ds = start ? new Date(start) : null;
        var de = end ? new Date(end) : null;
        if (ds && d < ds) return false;
        if (de && d > de) return false;
        return true;
    });

    function applyStatusFilter(){
        var statusVal = $('#filterStatus').val();
        // Kolom status index 6
        table.column(6).search(statusVal, true, false);
        table.draw();
    }

    $('#filterStart, #filterEnd').on('change', function(){
        table.draw();
    });
    $('#filterStatus').on('change', applyStatusFilter);
});
</script>
@endpush
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

    /* Surface filter di luar card agar lebarnya sejajar dengan card tabel */
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

    .table-responsive { border: 1px solid var(--soft-border); border-radius: 12px; box-shadow: 0 10px 24px rgba(17,24,39,0.08); padding: 8px 12px 12px; }
    #riwayatTable { border-collapse: separate; border-spacing: 0; }
    #riwayatTable thead th { background: linear-gradient(180deg, rgba(78,115,223,.14), rgba(78,115,223,.06)); color: #0f172a; border-bottom: 2px solid var(--soft-border); }
    #riwayatTable tbody tr:nth-child(odd) { background-color: #fbfdff; }
    #riwayatTable tbody tr:nth-child(even) { background-color: #f8fbff; }
    #riwayatTable tbody tr:hover { background-color: #eef4ff; }
    #riwayatTable td { border-color: var(--soft-border); }
    #riwayatTable td.dt-actions { white-space: nowrap; }
    #riwayatTable td.dt-actions .btn { margin-right: .25rem; }
    /* Perkecil kolom "No" (kolom ke-1) */
    #riwayatTable th:nth-child(1), #riwayatTable td:nth-child(1) {
        width: 56px !important;
        min-width: 56px !important;
        max-width: 56px !important;
        white-space: nowrap;
        padding-left: 8px;
        padding-right: 8px;
        text-align: center;
    }
</style>
@endpush
@endsection