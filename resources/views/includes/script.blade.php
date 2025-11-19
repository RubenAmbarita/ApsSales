<!-- Bootstrap core JavaScript-->
    
    <script src="{{url('backend/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{url('backend/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{url('backend/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{url('backend/js/sb-admin-2.min.js')}}"></script>

    <!-- Page level plugins -->
    <script src="{{url('backend/vendor/chart.js/Chart.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <!-- Removed global chart demo scripts to avoid errors on non-chart pages -->
    <!-- <script src="{{url('backend/js/demo/chart-area-demo.js')}}"></script> -->
    <!-- <script src="{{url('backend/js/demo/chart-pie-demo.js')}}"></script> -->

    <!-- jQuery (single source) and DataTables with Buttons/Responsive -->
    <!-- Removed duplicate jQuery CDN to prevent conflicts -->
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
    <script src="https://cdn.datatables.net/v/bs5/dt-2.1.0/b-2.4.1/b-html5-2.4.1/b-print-2.4.1/r-3.0.0/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

    <script>
    $(document).ready(function(){
        if ($('#towerTable').length) {
        $('#towerTable').DataTable({
        processing : true,
        serverSide : true,
        ordering : true,
        responsive: true,
        autoWidth: false,
        // DOM layout seragam seperti halaman Lisensi
        dom: "<'dt-toolbar d-flex flex-wrap align-items-center justify-content-between mb-2'<'dt-length'l><'dt-search'f>>t<'dt-footer d-flex flex-wrap justify-content-between align-items-center mt-2'<'dt-info'i><'dt-pagination'p>>",
        ajax: "{{ route('admin.tower.index') }}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex'},
            { data: 'tower_name', name: 'tower_name'},
            { data: 'stock_room', name: 'stock_room'},
            { 
                data: 'action', 
                name: 'action',
                orderable: false,
                searcable: false,
                width: '15%'
            },
        ],
        columnDefs: [
            { orderable: false, targets: [0,3] },
            { className: 'text-center', targets: [0,3] },
            { targets: 3, className: 'text-nowrap dt-actions', width: '140px' }
        ]

        });
        }
    });
    </script>


<!-- user -->
 <script>
    $(document).ready(function(){
        if ($('#userTable').length) {
        $('#userTable').DataTable({
        processing : false,
        serverSide : true,
        ordering : true,
        responsive: true,
        autoWidth: false,
        // DOM layout seragam seperti halaman Lisensi
        dom: "<'dt-toolbar d-flex flex-wrap align-items-center justify-content-between mb-2'<'dt-length'l><'dt-search'f>>t<'dt-footer d-flex flex-wrap justify-content-between align-items-center mt-2'<'dt-info'i><'dt-pagination'p>>",
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
        ajax: "{{ route('admin.user.index') }}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex'},
            { data: 'name', name: 'name'},
            { data: 'nip', name: 'nip'},
            { data: 'email', name: 'email'},
            { data: 'roles', name: 'roles'},
            { 
                data: 'action', 
                name: 'action',
                orderable: false,
                searcable: false,
                width: '15%'
            },
        ],
        columnDefs: [
            { orderable: false, targets: [0,5] },
            { className: 'text-center', targets: [0,5] },
            { targets: 5, className: 'text-nowrap dt-actions', width: '140px' }
        ]

        });

        // Bind refresh/export buttons for User page if present
        // Use the instance created above to avoid accidental re-initialization
        $('#btn-refresh').on('click', function(e){
            e.preventDefault();
            // Samakan perilaku dengan halaman Location: reload penuh agar terlihat indikator loading
            location.reload();
        });
        $('#btn-export-excel').on('click', function(e){
            e.preventDefault();
            if (typeof exportXLSX === 'function') {
                exportXLSX('Daftar_User');
            }
        });
        $('#btn-export-pdf').on('click', function(e){
            e.preventDefault();
            if (typeof exportPDF === 'function') {
                exportPDF('Daftar_User');
            }
        });

        // Initialize tooltips for action buttons
        $('[data-toggle="tooltip"]').tooltip();
        $('#userTable').on('draw.dt', function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
        }
    });
    </script>

    <!-- departemen unit -->
<script>
$(document).ready(function(){
    if ($('#departemenTable').length) {
    var table = $('#departemenTable').DataTable({
        processing: false,
        serverSide: true,
        responsive: true,
        autoWidth: false,
        // DOM layout seragam seperti halaman Lisensi
        dom: "<'dt-toolbar d-flex flex-wrap align-items-center justify-content-between mb-2'<'dt-length'l><'dt-search'f>>t<'dt-footer d-flex flex-wrap justify-content-between align-items-center mt-2'<'dt-info'i><'dt-pagination'p>>",
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
        ajax: "{{ route('admin.departemen.index') }}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'name', name: 'name' },
            { data: 'description', name: 'description' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ],
        columnDefs: [
            { orderable: false, targets: [0,3] },
            { className: 'text-center', targets: [0,3] },
            { targets: 3, className: 'text-nowrap dt-actions', width: '140px' }
        ]
    });

    // Reinitialize tooltips on table redraw (for action buttons)
    $('#departemenTable').on('draw.dt', function(){
        $('[data-toggle="tooltip"]').tooltip();
    });

    // Export Excel (XLSX) via SheetJS for Departemen
    function exportDepXLSX(filename) {
        var header = ["No", "Nama Direktorat", "Deskripsi"]; // header row
        var rows = [header];
        table.rows({ search: 'applied' }).every(function(){
            var d = this.data();
            rows.push([
                String((d && d.DT_RowIndex) ? d.DT_RowIndex : '').replace(/<[^>]*>/g,'').trim(),
                String((d && d.name) ? d.name : '').replace(/<[^>]*>/g,'').trim(),
                String((d && d.description) ? d.description : '').replace(/<[^>]*>/g,'').trim()
            ]);
        });
        var ws = XLSX.utils.aoa_to_sheet(rows);
        // Auto width columns
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
        XLSX.utils.book_append_sheet(wb, ws, 'Daftar Direktorat');
        XLSX.writeFile(wb, filename + '.xlsx');
    }

    // Export PDF via pdfmake for Departemen
    function exportDepPDF(filename) {
        var header = [
            { text: 'No', style: 'tableHeader' },
            { text: 'Nama Direktorat', style: 'tableHeader' },
            { text: 'Deskripsi', style: 'tableHeader' }
        ];
        var body = [header];
        table.rows({ search: 'applied' }).every(function(){
            var d = this.data();
            body.push([
                { text: String((d && d.DT_RowIndex) ? d.DT_RowIndex : '').replace(/<[^>]*>/g,'').trim(), alignment: 'center' },
                String((d && d.name) ? d.name : '').replace(/<[^>]*>/g,'').trim(),
                String((d && d.description) ? d.description : '').replace(/<[^>]*>/g,'').trim()
            ]);
        });
        var docDefinition = {
            pageOrientation: 'landscape',
            pageSize: 'A4',
            content: [
                { text: 'Daftar Direktorat', style: 'title', margin: [0,0,0,10] },
                {
                    table: {
                        headerRows: 1,
                        widths: ['auto', '*', '*'],
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

    // Dropdown actions bindings
    $('#btn-dep-refresh').on('click', function(e) { 
        e.preventDefault(); 
        // Samakan dengan Location: reload penuh agar indikator loading terlihat
        location.reload(); 
    });
    $('#btn-dep-export-excel').on('click', function(e) { e.preventDefault(); exportDepXLSX('Daftar_Direktorat'); });
    $('#btn-dep-export-pdf').on('click', function(e) { e.preventDefault(); exportDepPDF('Daftar_Direktorat'); });
    }
});
</script>

    <!-- vendor -->
    <script>
    $(document).ready(function(){
        if ($('#vendorTable').length) {
        var vTable = $('#vendorTable').DataTable({
            processing: false,
            serverSide: true,
            responsive: true,
            autoWidth: false,
            // DOM layout seragam seperti halaman Lisensi
            dom: "<'dt-toolbar d-flex flex-wrap align-items-center justify-content-between mb-2'<'dt-length'l><'dt-search'f>>t<'dt-footer d-flex flex-wrap justify-content-between align-items-center mt-2'<'dt-info'i><'dt-pagination'p>>",
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
            ajax: "{{ route('admin.vendor.index') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'name', name: 'name' },
                { data: 'pic', name: 'pic' },
                { data: 'telephone', name: 'telephone' },
                { data: 'address', name: 'address' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ],
            columnDefs: [
                { orderable: false, targets: [0,5] },
                { className: 'text-center', targets: [0,5] },
                { targets: 5, className: 'text-nowrap dt-actions', width: '140px' },
                { targets: '_all', defaultContent: '-' }
            ]
        });

        // Reinitialize tooltips on table redraw
        $('#vendorTable').on('draw.dt', function(){
            $('[data-toggle="tooltip"]').tooltip();
        });

        // Export Excel (XLSX) via SheetJS for Vendor
        function exportVendorXLSX(filename) {
            var header = ["No", "Nama Vendor", "PIC", "Telepon", "Alamat"];
            var rows = [header];
            vTable.rows({ search: 'applied' }).every(function(){
                var d = this.data();
                rows.push([
                    String((d && d.DT_RowIndex) ? d.DT_RowIndex : '').replace(/<[^>]*>/g,'').trim(),
                    String((d && d.name) ? d.name : '').replace(/<[^>]*>/g,'').trim(),
                    String((d && d.pic) ? d.pic : '').replace(/<[^>]*>/g,'').trim(),
                    String((d && d.telephone) ? d.telephone : '').replace(/<[^>]*>/g,'').trim(),
                    String((d && d.address) ? d.address : '').replace(/<[^>]*>/g,'').trim()
                ]);
            });
            var ws = XLSX.utils.aoa_to_sheet(rows);
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
            XLSX.utils.book_append_sheet(wb, ws, 'Daftar Vendor');
            XLSX.writeFile(wb, filename + '.xlsx');
        }

        // Export PDF via pdfmake for Vendor
        function exportVendorPDF(filename) {
            var header = [
                { text: 'No', style: 'tableHeader' },
                { text: 'Nama Vendor', style: 'tableHeader' },
                { text: 'PIC', style: 'tableHeader' },
                { text: 'Telepon', style: 'tableHeader' },
                { text: 'Alamat', style: 'tableHeader' }
            ];
            var body = [header];
            vTable.rows({ search: 'applied' }).every(function(){
                var d = this.data();
                body.push([
                    { text: String((d && d.DT_RowIndex) ? d.DT_RowIndex : '').replace(/<[^>]*>/g,'').trim(), alignment: 'center' },
                    String((d && d.name) ? d.name : '').replace(/<[^>]*>/g,'').trim(),
                    String((d && d.pic) ? d.pic : '').replace(/<[^>]*>/g,'').trim(),
                    String((d && d.telephone) ? d.telephone : '').replace(/<[^>]*>/g,'').trim(),
                    String((d && d.address) ? d.address : '').replace(/<[^>]*>/g,'').trim()
                ]);
            });
            var docDefinition = {
                pageOrientation: 'landscape',
                pageSize: 'A4',
                content: [
                    { text: 'Daftar Vendor', style: 'title', margin: [0,0,0,10] },
                    {
                        table: {
                            headerRows: 1,
                            widths: ['auto', '*', '*', '*', '*'],
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

        // Dropdown actions bindings for Vendor
        $('#btn-vendor-refresh').on('click', function(e) { e.preventDefault(); location.reload(); });
        $('#btn-vendor-export-excel').on('click', function(e) { e.preventDefault(); exportVendorXLSX('Daftar_Vendor'); });
        $('#btn-vendor-export-pdf').on('click', function(e) { e.preventDefault(); exportVendorPDF('Daftar_Vendor'); });
        }
    });
    </script>


    <!-- booking unit -->
     <script>
    $(document).ready(function(){
        if ($('#prosesTable').length) {
        $('#prosesTable').DataTable({
        processing : true,
        serverSide : true,
        ordering : true,
        ajax: "{{ route('admin.proses.index') }}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex'},
            { data: 'tower.tower_name', name: 'tower.tower_name]'},
            { data: 'unit', name: 'unit'},
            { data: 'user.name', name: 'user.name'},
            { data: 'status', name: 'status'},
            { data: 'price', render: $.fn.dataTable.render.number( ',', '.', 3, 'Rp' )},
            { 
                data: 'action', 
                name: 'action',
                orderable: false,
                searcable: false,
                width: '15%'
            },
        ],
        initComplete: function() {
                this.api()
                .columns([4])
                .every(function() {
                    var column = this;
                    var select = $('<select class="form-control form-control--filter"><option value=""> -- Filter -- </option></select>')
                    .appendTo($('thead tr:eq(1) td:eq(' + this.index() + ')'))
                    .on('change', function() {
                        var val = $.fn.dataTable.util.escapeRegex(
                        $(this).val()
                        );
                        column
                        .search(val ? '^' + val + '$' : '', true, false)
                        .draw();
                    });

                    column.data().unique().sort().each(function(d, j) {
                    if (!d == '') {
                        select.append('<option value="' + d + '">' + d + '</option>');
                    }
                    });
                });
            },
            stateLoadParams: function(settings, data) {
                for (i = 0; i < data.columns["length"]; i++) {
                var col_search_val = data.columns[i].search.search;

                if (col_search_val != "") {
                    var filterColumn = $("#example thead tr:eq(1) td:eq(" + i + ") select");
                    console.log(filterColumn, i);
                }
                }
            }

        });
        }
    });
    </script>

    <!-- network -->
    <script>
    $(document).ready(function(){
        if ($('#networkTable').length) {
            var nTable = $('#networkTable').DataTable({
                processing: false,
                serverSide: false,
                responsive: false,
                autoWidth: false,
                scrollX: true,
                // Layout kontrol mengikuti halaman Lisensi untuk konsistensi & alignment
                dom: "<'dt-toolbar d-flex flex-wrap align-items-center justify-content-between mb-2'<'dt-length'l><'dt-search'f>>t<'dt-footer d-flex flex-wrap justify-content-between align-items-center mt-2'<'dt-info'i><'dt-pagination'p>>",
                // Jika ekstensi Responsive tidak tersedia di CDN, aktifkan scroll horizontal sebagai fallback
                // details config dihapus untuk menghindari error ketika $.fn.dataTable.Responsive tidak terdefinisi
                // Gunakan scroll horizontal agar konten kolom lebar (Brand/Fungsi/Lokasi) tidak terpotong
                // Nonaktifkan Responsive untuk tabel ini agar lebar kolom tetap konsisten
                responsive: false,
                scrollX: true,
                stripeClasses: [],
                order: [],
                pageLength: 10,
                lengthMenu: [[10,25,50,100],[10,25,50,100]],
                language: {
                    decimal: ",",
                    thousands: ".",
                    lengthMenu: "Tampilkan _MENU_ data per halaman",
                    emptyTable: "Tidak ada data perangkat jaringan",
                    zeroRecords: "Tidak ada data perangkat jaringan",
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
                columnDefs: [
                    { orderable: false, targets: [0,10] },
                    { className: 'text-center dtr-control', targets: [0] },
                    { className: 'text-center', targets: [10] },
                    { className: 'text-center', targets: [9] },
                    { className: 'text-left', targets: [6] },
                    { targets: 0, width: '48px' },
                    { targets: 10, width: '160px' },
                    { targets: 4, width: '180px' },
                    { targets: 9, width: '130px' },
                    { targets: [1,2,3], width: '180px' },
                    { targets: [7,8], width: '150px' },
                    { targets: [5,6], width: '140px' },
                    { targets: '_all', defaultContent: '' },
                    // Responsive priorities: kolom yang disembunyikan terlebih dahulu di layar kecil
                    { responsivePriority: 1, targets: [0,10] }, // pertahankan No (control) & Aksi
                    { responsivePriority: 2, targets: [1,2,3] }, // Brand, Fungsi, Lokasi
                    { responsivePriority: 3, targets: [4,5] }, // Vendor, Serial Number
                    { responsivePriority: 4, targets: [6] },     // Tahun Produksi
                    { responsivePriority: 5, targets: [7,8,9] }  // End of Sale/Support/Status — disembunyikan lebih dulu
                ]
            });

            // Re-init tooltips on redraw
            $('#networkTable').on('draw.dt', function(){
                $('[data-toggle="tooltip"]').tooltip();
            });

            // Export Excel (XLSX) for Network
            function exportNetworkXLSX(filename) {
                var header = ["No", "Brand", "Fungsi", "Lokasi", "Vendor", "Serial Number", "Tahun Produksi", "End of Sale", "End of Support", "Status"]; // header row
                var rows = [header];
                nTable.rows({ search: 'applied' }).every(function(){
                    var $row = $(this.node());
                    rows.push([
                        $row.find('td').eq(0).text().trim(),
                        $row.find('td').eq(1).text().trim(),
                        $row.find('td').eq(2).text().trim(),
                        $row.find('td').eq(3).text().trim(),
                        $row.find('td').eq(4).text().trim(),
                        $row.find('td').eq(5).text().trim(),
                        $row.find('td').eq(6).text().trim(),
                        $row.find('td').eq(7).text().trim(),
                        $row.find('td').eq(8).text().trim(),
                        $row.find('td').eq(9).text().trim()
                    ]);
                });
                var ws = XLSX.utils.aoa_to_sheet(rows);
                // Auto width columns
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
                XLSX.utils.book_append_sheet(wb, ws, 'Daftar Perangkat Jaringan');
                XLSX.writeFile(wb, filename + '.xlsx');
            }

            // Export PDF via pdfmake for Network
            function exportNetworkPDF(filename) {
                var header = [
                    { text: 'No', style: 'tableHeader' },
                    { text: 'Brand', style: 'tableHeader' },
                    { text: 'Fungsi', style: 'tableHeader' },
                    { text: 'Lokasi', style: 'tableHeader' },
                    { text: 'Vendor', style: 'tableHeader' },
                    { text: 'Serial Number', style: 'tableHeader' },
                    { text: 'Tahun Produksi', style: 'tableHeader' },
                    { text: 'End of Sale', style: 'tableHeader' },
                    { text: 'End of Support', style: 'tableHeader' },
                    { text: 'Status', style: 'tableHeader' }
                ];
                var body = [header];
                nTable.rows({ search: 'applied' }).every(function(){
                    var $row = $(this.node());
                    body.push([
                        { text: $row.find('td').eq(0).text().trim(), alignment: 'center' },
                        $row.find('td').eq(1).text().trim(),
                        $row.find('td').eq(2).text().trim(),
                        $row.find('td').eq(3).text().trim(),
                        $row.find('td').eq(4).text().trim(),
                        $row.find('td').eq(5).text().trim(),
                        $row.find('td').eq(6).text().trim(),
                        $row.find('td').eq(7).text().trim(),
                        $row.find('td').eq(8).text().trim(),
                        $row.find('td').eq(9).text().trim()
                    ]);
                });
                var docDefinition = {
                    pageOrientation: 'landscape',
                    pageSize: 'A4',
                    content: [
                        { text: 'Daftar Perangkat Jaringan', style: 'title', margin: [0,0,0,10] },
                        {
                            table: {
                                headerRows: 1,
                                widths: ['auto', '*', '*', '*', '*', '*', 'auto', 'auto', 'auto', 'auto'],
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

            // Bind export buttons
            $('#btn-network-export-excel').on('click', function(e) { e.preventDefault(); exportNetworkXLSX('Daftar_Perangkat_Jaringan'); });
            $('#btn-network-export-pdf').on('click', function(e) { e.preventDefault(); exportNetworkPDF('Daftar_Perangkat_Jaringan'); });
        }
    });
    </script>


    <!-- booking unit -->
     <script>
    $(document).ready(function(){
        if ($('#approveTable').length) {
        $('#approveTable').DataTable({
        processing : true,
        serverSide : true,
        ordering : true,
        ajax: "{{ route('admin.approve.index') }}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex'},
            { data: 'tower.tower_name', name: 'tower.tower_name]'},
            { data: 'unit', name: 'unit'},
            { data: 'user.name', name: 'user.name'},
            { data: 'status', name: 'status'},
            { data: 'price', render: $.fn.dataTable.render.number( ',', '.', 3, 'Rp' )},
            { 
                data: 'action', 
                name: 'action',
                orderable: false,
                searcable: false,
                width: '15%'
            },
        ],
        initComplete: function() {
                this.api()
                .columns([4])
                .every(function() {
                    var column = this;
                    var select = $('<select class="form-control form-control--filter"><option value=""> -- Filter -- </option></select>')
                    .appendTo($('thead tr:eq(1) td:eq(' + this.index() + ')'))
                    .on('change', function() {
                        var val = $.fn.dataTable.util.escapeRegex(
                        $(this).val()
                        );
                        column
                        .search(val ? '^' + val + '$' : '', true, false)
                        .draw();
                    });

                    column.data().unique().sort().each(function(d, j) {
                    if (!d == '') {
                        select.append('<option value="' + d + '">' + d + '</option>');
                    }
                    });
                });
            },
            stateLoadParams: function(settings, data) {
                for (i = 0; i < data.columns["length"]; i++) {
                var col_search_val = data.columns[i].search.search;

                if (col_search_val != "") {
                    var filterColumn = $("#example thead tr:eq(1) td:eq(" + i + ") select");
                    console.log(filterColumn, i);
                }
                }
            }

        });
        }
    });
    </script>

    <script>
    // Password visibility toggle (works across Create/Edit User pages)
    $(document).on('click', '.toggle-password', function(){
        var targetSelector = $(this).data('target');
        var $input = $(targetSelector);
        if (!$input.length) return;
    
        var $icon = $(this).find('i');
        if ($input.attr('type') === 'password') {
            $input.attr('type', 'text');
            $icon.removeClass('fa-eye').addClass('fa-eye-slash');
        } else {
            $input.attr('type', 'password');
            $icon.removeClass('fa-eye-slash').addClass('fa-eye');
        }
    });
    </script>
    <script>
        function convertToRupiah(angka)
        {
            var rupiah = ''; 		
            var angkarev = angka.toString().split('').reverse().join('');
            for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
            return 'Rp. '+rupiah.split('',rupiah.length-1).reverse().join('');
        }
        var priceEl = document.getElementById('price');
        if (priceEl && priceEl.value) {
            priceEl.value = convertToRupiah(priceEl.value);
        }
    </script>

    <!-- lisensi -->
    @push('addon-script')
    <script>
        $(document).ready(function() {
            // Lisensi table
            if ($('#tableLisensi').length) {
                // Initialize Select2 for vendor dropdown
                if ($('#filterVendor').length && $.fn.select2) {
                    $('#filterVendor').select2({
                        width: '100%',
                        placeholder: 'Pilih vendor...',
                        allowClear: true,
                        dropdownParent: $('#filterVendor').parent(),
                        dropdownAutoWidth: false,
                        selectionCssClass: 's2-selection',
                        dropdownCssClass: 's2-dropdown'
                    }).on('change', function(){
                        // Auto apply when value changes
                        if ($.fn.dataTable.isDataTable('#tableLisensi')) {
                            $('#tableLisensi').DataTable().ajax.reload();
                        }
                    });
                }
                // Initialize Select2 for status dropdown
                if ($('#filterStatus').length && $.fn.select2) {
                    $('#filterStatus').select2({
                        width: '100%',
                        placeholder: 'Semua Status',
                        allowClear: true,
                        dropdownParent: $('#filterStatus').parent(),
                        dropdownAutoWidth: false,
                        selectionCssClass: 's2-selection',
                        dropdownCssClass: 's2-dropdown'
                    }).on('change', function(){
                        // Auto apply when value changes
                        if ($.fn.dataTable.isDataTable('#tableLisensi')) {
                            $('#tableLisensi').DataTable().ajax.reload();
                        }
                    });
                }

                // Flag role STAFF untuk kontrol readonly di client-side
                var isStaff = {!! json_encode(Auth::user() && Auth::user()->roles === 'STAFF') !!};
                var lTable = $('#tableLisensi').DataTable({
                    processing: false,
                    serverSide: true,
                    responsive: true,
                    autoWidth: false,
                    // Layout kontrol DataTables dibuat fleksibel dan responsif
                    dom: "<'dt-toolbar d-flex flex-wrap align-items-center justify-content-between mb-2'<'dt-length'l><'dt-search'f>>" +
                         "t" +
                         "<'dt-footer d-flex flex-wrap justify-content-between align-items-center mt-2'<'dt-info'i><'dt-pagination'p>>",
                    ajax: {
                        url: "{{ route('admin.lisensi.index') }}",
                        data: function(d) {
                            d.filter_vendor_id = $('#filterVendor').val();
                            d.filter_status = $('#filterStatus').val();
                        }
                    },
                    columns: [
                        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                        { data: 'vendor_name', name: 'vendor.name' },
                        { data: 'software_name', name: 'software_name' },
                        { data: 'function', name: 'function' },
                        { data: 'masa_berlaku', name: 'masa_berlaku', orderable: false, searchable: false },
                        { data: 'status', name: 'status', orderable: false, searchable: false },
                        { data: 'action', name: 'action', orderable: false, searchable: false },
                    ],
                    order: [], // jangan aktifkan urutan default pada kolom Vendor
                    columnDefs: [
                        { targets: [0, 6], orderable: false },
                        { targets: 0, className: 'text-center', width: '56px' },
                        { targets: 6, className: 'text-nowrap dt-actions', width: '140px' },
                        // Tampilkan kolom Aksi untuk semua role; konten tombol dikendalikan di server-side (controller)
                        { targets: 6, visible: true },
                        { targets: 5, className: 'text-center' },
                        { targets: '_all', defaultContent: '-' }
                    ],
                    language: {
                        url: "https://cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"
                    }
                });

                // Placeholder untuk kolom pencarian agar lebih informatif
                lTable.on('init.dt', function(){
                    $('#tableLisensi_filter input').attr('placeholder','Cari lisensi...');
                });

                // Adjust table columns on Select2 open/close to reduce layout shift
                $('#filterVendor, #filterStatus').on('select2:open select2:close', function(){
                    lTable.columns.adjust();
                });

                // Reinitialize tooltips on table redraw (for action buttons)
                $('#tableLisensi').on('draw.dt', function(){
                    $('[data-toggle="tooltip"]').tooltip();
                });

                // Remove apply/reset and enter logic since filters auto-apply
            }

            // Other existing initializations ...
        });
    </script>


    @endpush

    @push('addon-script')
    <script>
        $(document).ready(function() {
            // Server table
            if ($('#tableServer').length) {
                // Flag role STAFF untuk kontrol readonly di client-side
                var isStaff = {!! json_encode(Auth::user() && Auth::user()->roles === 'STAFF') !!};
                var srvTable = $('#tableServer').DataTable({
                    processing: false,
                    serverSide: true,
                    responsive: true,
                    autoWidth: false,
                    dom: "<'dt-toolbar d-flex flex-wrap align-items-center justify-content-between mb-2'<'dt-length'l><'dt-search'f>>" +
                         "t" +
                         "<'dt-footer d-flex flex-wrap justify-content-between align-items-center mt-2'<'dt-info'i><'dt-pagination'p>>",
                    ajax: {
                        url: "{{ route('admin.server.index') }}"
                    },
                    columns: [
                        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                        { data: 'no_rack', name: 'no_rack' },
                        { data: 'rack_unit', name: 'rack_unit' },
                        { data: 'brand', name: 'brand' },
                        { data: 'model', name: 'model' },
                        { data: 'serial_number', name: 'serial_number' },
                        { data: 'application', name: 'application' },
                        { data: 'status', name: 'status', orderable: false, searchable: false },
                        { data: 'procurement_date', name: 'procurement_date' },
                        { data: 'acquition_date', name: 'acquition_date' },
                        { data: 'action', name: 'action', orderable: false, searchable: false },
                    ],
                    order: [],
                    columnDefs: [
                        { targets: [0, 10], orderable: false },
                        { targets: 10, className: 'text-nowrap dt-actions', width: '140px' },
                        // Tampilkan kolom Aksi untuk semua role; konten tombol dikendalikan di server-side (controller)
                        { targets: 10, visible: true },
                        { targets: 0, className: 'text-center', width: '56px' },
                        { targets: '_all', defaultContent: '-' }
                    ],
                    language: {
                        url: "https://cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"
                    }
                });

                // Placeholder untuk kolom pencarian
                srvTable.on('init.dt', function(){
                    $('#tableServer_filter input').attr('placeholder','Cari server...');
                });

                // Reinitialize tooltips on table redraw
                $('#tableServer').on('draw.dt', function(){
                    $('[data-toggle="tooltip"]').tooltip();
                });

                // Export Excel (XLSX) via SheetJS untuk Server
                function exportServerXLSX(filename) {
                    var header = [
                        "No", "No Rack", "Rack Unit", "Brand", "Model", "Serial Number", "Aplikasi", "Status", "Tgl Pengadaan", "Tgl Perolehan"
                    ];
                    var rows = [header];
                    srvTable.rows({ search: 'applied' }).every(function(){
                        var d = this.data();
                        rows.push([
                            String((d && d.DT_RowIndex) ? d.DT_RowIndex : '').replace(/<[^>]*>/g,'').trim(),
                            String((d && d.no_rack) ? d.no_rack : '').replace(/<[^>]*>/g,'').trim(),
                            String((d && d.rack_unit) ? d.rack_unit : '').replace(/<[^>]*>/g,'').trim(),
                            String((d && d.brand) ? d.brand : '').replace(/<[^>]*>/g,'').trim(),
                            String((d && d.model) ? d.model : '').replace(/<[^>]*>/g,'').trim(),
                            String((d && d.serial_number) ? d.serial_number : '').replace(/<[^>]*>/g,'').trim(),
                            String((d && d.application) ? d.application : '').replace(/<[^>]*>/g,'').trim(),
                            String((d && d.status) ? d.status : '').replace(/<[^>]*>/g,'').trim(),
                            String((d && d.procurement_date) ? d.procurement_date : '').replace(/<[^>]*>/g,'').trim(),
                            String((d && d.acquition_date) ? d.acquition_date : '').replace(/<[^>]*>/g,'').trim()
                        ]);
                    });
                    var ws = XLSX.utils.aoa_to_sheet(rows);
                    // Auto width columns
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
                    XLSX.utils.book_append_sheet(wb, ws, 'Daftar Server');
                    XLSX.writeFile(wb, filename + '.xlsx');
                }

                // Export PDF via pdfmake untuk Server
                function exportServerPDF(filename) {
                    var header = [
                        { text: 'No', style: 'tableHeader' },
                        { text: 'No Rack', style: 'tableHeader' },
                        { text: 'Rack Unit', style: 'tableHeader' },
                        { text: 'Brand', style: 'tableHeader' },
                        { text: 'Model', style: 'tableHeader' },
                        { text: 'Serial Number', style: 'tableHeader' },
                        { text: 'Aplikasi', style: 'tableHeader' },
                        { text: 'Status', style: 'tableHeader' },
                        { text: 'Tgl Pengadaan', style: 'tableHeader' },
                        { text: 'Tgl Perolehan', style: 'tableHeader' }
                    ];
                    var body = [header];
                    srvTable.rows({ search: 'applied' }).every(function(){
                        var d = this.data();
                        body.push([
                            { text: String((d && d.DT_RowIndex) ? d.DT_RowIndex : '').replace(/<[^>]*>/g,'').trim(), alignment: 'center' },
                            String((d && d.no_rack) ? d.no_rack : '').replace(/<[^>]*>/g,'').trim(),
                            String((d && d.rack_unit) ? d.rack_unit : '').replace(/<[^>]*>/g,'').trim(),
                            String((d && d.brand) ? d.brand : '').replace(/<[^>]*>/g,'').trim(),
                            String((d && d.model) ? d.model : '').replace(/<[^>]*>/g,'').trim(),
                            String((d && d.serial_number) ? d.serial_number : '').replace(/<[^>]*>/g,'').trim(),
                            String((d && d.application) ? d.application : '').replace(/<[^>]*>/g,'').trim(),
                            String((d && d.status) ? d.status : '').replace(/<[^>]*>/g,'').trim(),
                            String((d && d.procurement_date) ? d.procurement_date : '').replace(/<[^>]*>/g,'').trim(),
                            String((d && d.acquition_date) ? d.acquition_date : '').replace(/<[^>]*>/g,'').trim()
                        ]);
                    });
                    var docDefinition = {
                        pageOrientation: 'landscape',
                        pageSize: 'A4',
                        content: [
                            { text: 'Daftar Server', style: 'title', margin: [0,0,0,10] },
                            {
                                table: {
                                    headerRows: 1,
                                    widths: ['auto', 'auto', 'auto', '*', '*', '*', '*', 'auto', 'auto', 'auto'],
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

                // Binding tombol dropdown ekspor
                $('#btn-server-export-excel').on('click', function(e) { e.preventDefault(); exportServerXLSX('Daftar_Server'); });
                $('#btn-server-export-pdf').on('click', function(e) { e.preventDefault(); exportServerPDF('Daftar_Server'); });
            }
        });
    </script>
    @endpush
    
    @push('addon-script')
    <script>
        $(document).ready(function() {
            // SOP table
            if ($('#tableSop').length) {
                // Flag role STAFF untuk kontrol readonly di client-side
                var isStaff = {!! json_encode(Auth::user() && Auth::user()->roles === 'STAFF') !!};
                var sTable = $('#tableSop').DataTable({
                    processing: false,
                    serverSide: true,
                    responsive: true,
                    autoWidth: false,
                    // Layout kontrol DataTables dibuat fleksibel dan responsif (seragam dengan Lisensi)
                    dom: "<'dt-toolbar d-flex flex-wrap align-items-center justify-content-between mb-2'<'dt-length'l><'dt-search'f>>" +
                         "t" +
                         "<'dt-footer d-flex flex-wrap justify-content-between align-items-center mt-2'<'dt-info'i><'dt-pagination'p>>",
                    ajax: {
                        url: "{{ route('admin.sop.index') }}"
                    },
                    columns: [
                        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                        { data: 'no_sop', name: 'no_sop' },
                        { data: 'name', name: 'name' },
                        { data: 'version', name: 'version' },
                        { data: 'owner', name: 'owner' },
                        { data: 'effective_date', name: 'effective_date', orderable: false, searchable: false },
                        { data: 'approved_by', name: 'approved_by' },
                        { data: 'action', name: 'action', orderable: false, searchable: false },
                    ],
                    order: [],
                    columnDefs: [
                        { targets: [0, 7], orderable: false },
                        { targets: 7, className: 'text-nowrap dt-actions', width: '140px' },
                        // Tampilkan kolom Aksi untuk semua role; konten tombol dikendalikan di server-side (controller)
                        { targets: 7, visible: true },
                        // Perkecil kolom "No"
                        { targets: 0, className: 'text-center', width: '56px' },
                        // Perlebar kolom "Pemilik" (index 4)
                        { targets: 4, className: 'text-left', width: '240px' },
                        { targets: '_all', defaultContent: '-' }
                    ],
                    language: {
                        url: "https://cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"
                    }
                });

                // Placeholder untuk kolom pencarian agar lebih informatif
                sTable.on('init.dt', function(){
                    $('#tableSop_filter input').attr('placeholder','Cari SOP...');
                });

                // Reinitialize tooltips on table redraw (for action buttons)
                $('#tableSop').on('draw.dt', function(){
                    $('[data-toggle="tooltip"]').tooltip();
                });

                // Bind export dropdown if functions are globally available
                $('#btn-sop-export-excel').on('click', function(e){
                    e.preventDefault();
                    if (typeof exportXLSX === 'function') {
                        exportXLSX('Daftar_SOP');
                    }
                });
                $('#btn-sop-export-pdf').on('click', function(e){
                    e.preventDefault();
                    if (typeof exportPDF === 'function') {
                        exportPDF('Daftar_SOP');
                    }
                });
            }
        });
    </script>
    @endpush