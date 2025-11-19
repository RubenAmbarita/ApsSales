<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <title>SIMANTAP - Dashboard Monitoring</title>
    <link rel="icon" type="image/png" href="{{ asset('frontend/images/simantap.png') }}">

    @include('includes.style')
    @stack('addon-style')
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('includes.sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column" style="background-color: #FFFFFF !important">

            <!-- Main Content -->
            <div id="content">

                @include('includes.navbar')

                @yield('content')

            </div>
            <!-- End of Main Content -->

            @include('includes.footer')

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Anda Yakin Keluar ?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Pilih tombol "Logout" jika anda ingin keluar dari aplikasi.</div>
                <div class="modal-footer">
                    <form action="{{ url('logout') }}" method="POST">
                        @csrf
                        <button class="btn btn-light-soft btn-rounded-10" type="button" data-dismiss="modal">
                            <i class="fas fa-times mr-1"></i>
                            Cancel
                        </button>
                        <button class="btn btn-soft-danger btn-elevated btn-rounded-10" type="submit">
                            <i class="fas fa-power-off mr-1"></i>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    @include('includes.script')
    @stack('addon-script')
    @yield('scripts')
</body>

</html>
