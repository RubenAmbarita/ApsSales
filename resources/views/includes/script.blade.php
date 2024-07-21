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
    <script src="{{url('backend/js/demo/chart-area-demo.js')}}"></script>
    <script src="{{url('backend/js/demo/chart-pie-demo.js')}}"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-2.1.0/datatables.min.js"></script>
    <script>
    $(document).ready(function(){
        $('#towerTable').DataTable({
        processing : true,
        serverSide : true,
        ordering : true,
        ajax: "{{route('tower.index')}}",
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
        ]

        });
    });
    </script>


<!-- user -->
 <script>
    $(document).ready(function(){
        $('#userTable').DataTable({
        processing : true,
        serverSide : true,
        ordering : true,
        ajax: "{{route('user.index')}}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex'},
            { data: 'name', name: 'name'},
            { data: 'email', name: 'email'},
            { data: 'roles', name: 'roles'},
            { 
                data: 'action', 
                name: 'action',
                orderable: false,
                searcable: false,
                width: '15%'
            },
        ]

        });
    });
    </script>

    <!-- stock unit -->
 <script>
    $(document).ready(function(){
        $('#stockTable').DataTable({
        processing : true,
        serverSide : true,
        ordering : true,
        ajax: "{{route('stock.index')}}",
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
    });
    </script>

    <!-- booking unit -->
     <script>
    $(document).ready(function(){
        $('#prosesTable').DataTable({
        processing : true,
        serverSide : true,
        ordering : true,
        ajax: "{{route('proses.index')}}",
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
    });
    </script>

    <!-- booking unit -->
     <script>
    $(document).ready(function(){
        $('#approveTable').DataTable({
        processing : true,
        serverSide : true,
        ordering : true,
        ajax: "{{route('approve.index')}}",
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
        let price = convertToRupiah(document.getElementById('price').value);
        document.getElementById('price').value = price;
    </script>