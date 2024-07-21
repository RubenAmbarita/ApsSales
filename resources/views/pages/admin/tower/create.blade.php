@extends('layouts.admin')


@section('content')
    <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Tower</h1>
                        <a href="{{route('tower.create')}}" class="btn btn-sm btn-primary shadow-sm">
                            <i class="fas fa-plus fa-sm text-white-50"></i>Tambah Tower
                        </a>
                    </div>

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>

                    @endif

                    <div class="card shadow">
                        <div class="card-body">
                            <form action="{{route('tower.store')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="tower_name">Nama Tower</label>
                                    <input type="text" class="form-control" name="tower_name" placeholder="Nama Tower" value="{{old('tower_name')}}">
                                </div>
                                <div class="form-group">
                                    <label for="stock_room">Stok</label>
                                    <input type="number" class="form-control" name="stock_room" placeholder="Jumlah Stok" value="{{old('stock_room')}}">
                                </div>

                                <button type="submit" class="btn btn-primary btn-block">
                                    Simpan
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
@endsection