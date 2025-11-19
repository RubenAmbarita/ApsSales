@extends('layouts.admin')
<link href="https://cdn.datatables.net/v/bs5/dt-2.1.0/datatables.min.css" rel="stylesheet">
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Manajemen Vendor</h1>
            <!-- Tambah dipindah ke header card agar bersebelahan dengan dropdown Ekspor -->
        </div>

        <!-- Content Row -->
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4 card-soft">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Daftar Vendor</h6>
                        <div class="header-actions d-flex align-items-center">
                            <a href="{{ route('admin.vendor.create') }}" class="btn btn-sm btn-soft-primary btn-pill btn-elevated mr-2">
                                <i class="fas fa-plus mr-1"></i> Tambah
                            </a>
                            <div class="dropdown">
                                <a class="btn btn-sm btn-soft-teal btn-pill btn-elevated dropdown-toggle" href="#" role="button" id="vendorExportMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-file-export mr-1"></i> Ekspor
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in export-menu" aria-labelledby="vendorExportMenu">
                                    <div class="export-menu__header">
                                        <div class="export-menu__title">Pilih Format</div>
                                    </div>
                                    <a class="dropdown-item export-item" href="#" id="btn-vendor-export-excel">
                                        <span class="export-item__icon bg-soft-success"><i class="fas fa-file-excel"></i></span>
                                        <span class="export-item__text">
                                            <strong>Export Excel</strong>
                                            <small class="text-muted d-block">Format .xlsx</small>
                                        </span>
                                    </a>
                                    <a class="dropdown-item export-item" href="#" id="btn-vendor-export-pdf">
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
                            <table id="vendorTable" class="table table-hover align-middle soft-table" style="width:100%">
                                <thead class="thead-light">
                                    <tr>
                                        <th width="5%">No</th>
                                        <th>Nama Vendor</th>
                                        <th>PIC</th>
                                        <th>Telepon</th>
                                        <th>Alamat</th>
                                        <th width="15%" class="dt-actions text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
