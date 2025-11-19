@extends('layouts.admin')
<link href="https://cdn.datatables.net/v/bs5/dt-2.1.0/b-2.4.1/b-html5-2.4.1/b-print-2.4.1/r-3.0.0/datatables.min.css" rel="stylesheet">

@section('title', 'Manajemen Lokasi')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manajemen Lokasi</h1>
        <!-- Tambah dipindah ke header card agar bersebelahan dengan dropdown Ekspor -->
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4 card-soft">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Lokasi</h6>
                    <div class="header-actions d-flex align-items-center">
                        <a href="{{ route('admin.location.create') }}" class="btn btn-sm btn-soft-primary btn-pill btn-elevated mr-2">
                            <i class="fas fa-plus mr-1"></i> Tambah
                        </a>
                        <div class="dropdown">
                            <a class="btn btn-sm btn-soft-teal btn-pill btn-elevated dropdown-toggle" href="#" role="button" id="locationExportMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-file-export mr-1"></i> Ekspor
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in export-menu" aria-labelledby="locationExportMenu">
                                <div class="export-menu__header">
                                    <div class="export-menu__title">Pilih Format</div>
                                </div>
                                <a class="dropdown-item export-item" href="#" id="btn-export-excel">
                                    <span class="export-item__icon bg-soft-success"><i class="fas fa-file-excel"></i></span>
                                    <span class="export-item__text">
                                        <strong>Export Excel</strong>
                                        <small class="text-muted d-block">Format .xlsx</small>
                                    </span>
                                </a>
                                <a class="dropdown-item export-item" href="#" id="btn-export-pdf">
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
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                    <div class="table-responsive soft-table-wrapper">
                        <table class="table table-hover align-middle soft-table" id="locationTable" width="100%" cellspacing="0">
                            <thead class="thead-light">
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Nama Lokasi</th>
                                    <th>Gedung/Area</th>
                                    <th>Ruangan</th>
                                    <th>Lantai</th>
                                    <th width="15%" class="dt-actions text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($locations as $location)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $location->name }}</td>
                                    <td>{{ $location->location }}</td>
                                    <td>{{ $location->room }}</td>
                                    <td>{{ $location->floor }}</td>
                                    <td class="text-center dt-actions">
                                        <a href="{{ route('admin.location.show', $location->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.location.edit', $location->id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <i class="fa fa-pencil-alt"></i>
                                        </a>
                                        <form action="{{ route('admin.location.destroy', $location->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" data-toggle="tooltip" data-placement="top" title="Hapus">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada data lokasi</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- Dependensi untuk ekspor PDF -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<!-- SheetJS (XLSX) untuk ekspor Excel asli -->
<script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>

<script>
    $(document).ready(function() {
        var table = $('#locationTable').DataTable({
            responsive: true,
            autoWidth: false,
            // DOM layout seragam seperti halaman Lisensi
            dom: "<'dt-toolbar d-flex flex-wrap align-items-center justify-content-between mb-2'<'dt-length'l><'dt-search'f>>t<'dt-footer d-flex flex-wrap justify-content-between align-items-center mt-2'<'dt-info'i><'dt-pagination'p>>",
            stripeClasses: [],
            order: [],
            columnDefs: [
                { orderable: false, targets: [0,5] },
                { className: 'text-center', targets: [0,5] },
                { targets: 5, className: 'text-nowrap dt-actions', width: '140px' }
            ],
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
            }
        });
        
        // Placeholder untuk pencarian
        $('.dataTables_filter input').attr('placeholder','Cari lokasi, area, ruangan...').addClass('form-control form-control-sm');
        
        // Export Excel (XLSX) via SheetJS
        function exportXLSX(filename) {
            var header = [];
            $('#locationTable thead th').each(function(i){ if(i < 5){ header.push($(this).text().trim()); }});
            var rows = [header];
            table.rows({ search: 'applied' }).every(function(){
                var d = this.data();
                rows.push([
                    String(d[0]).replace(/<[^>]*>/g,'').trim(),
                    String(d[1]).replace(/<[^>]*>/g,'').trim(),
                    String(d[2]).replace(/<[^>]*>/g,'').trim(),
                    String(d[3]).replace(/<[^>]*>/g,'').trim(),
                    String(d[4]).replace(/<[^>]*>/g,'').trim()
                ]);
            });

            var ws = XLSX.utils.aoa_to_sheet(rows);

            // Auto width kolom berdasarkan panjang konten
            var colWidths = rows[0].map(function(_, colIdx){
                var maxLen = 0;
                for (var r = 0; r < rows.length; r++) {
                    var cell = rows[r][colIdx] != null ? String(rows[r][colIdx]) : '';
                    if (cell.length > maxLen) maxLen = cell.length;
                }
                return { wch: Math.max(10, maxLen) };
            });
            ws['!cols'] = colWidths;

            var wb = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(wb, ws, 'Daftar Lokasi');
            XLSX.writeFile(wb, filename + '.xlsx');
        }

        // Export PDF via pdfmake
        function exportPDF(filename) {
            var header = [];
            $('#locationTable thead th').each(function(i){ if(i < 5){ header.push({ text: $(this).text().trim(), style: 'tableHeader' }); }});
            var body = [header];
            table.rows({ search: 'applied' }).every(function(){
                var d = this.data();
                body.push([
                    { text: String(d[0]).replace(/<[^>]*>/g,'').trim(), alignment: 'center' },
                    String(d[1]).replace(/<[^>]*>/g,'').trim(),
                    String(d[2]).replace(/<[^>]*>/g,'').trim(),
                    String(d[3]).replace(/<[^>]*>/g,'').trim(),
                    String(d[4]).replace(/<[^>]*>/g,'').trim()
                ]);
            });
            var docDefinition = {
                pageOrientation: 'landscape',
                pageSize: 'A4',
                content: [
                    { text: 'Daftar Lokasi', style: 'title', margin: [0,0,0,10] },
                    {
                        table: {
                            headerRows: 1,
                            widths: ['auto', '*', '*', '*', 'auto'],
                            body: body
                        },
                        layout: 'lightHorizontalLines'
                    }
                ],
                styles: {
                    title: { fontSize: 14, bold: true, alignment: 'center' },
                    tableHeader: { bold: true }
                }
            };
            pdfMake.createPdf(docDefinition).download(filename + '.pdf');
        }

        // Dropdown actions
        $('#btn-refresh').on('click', function(e) { e.preventDefault(); location.reload(); });
        $('#btn-export-excel').on('click', function(e) { e.preventDefault(); exportXLSX('Daftar_Lokasi'); });
        $('#btn-export-pdf').on('click', function(e) { e.preventDefault(); exportPDF('Daftar_Lokasi'); });

        // Initialize tooltips
        $('[data-toggle="tooltip"]').tooltip();
        $('#locationTable').on('draw.dt', function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    });
</script>
@endsection