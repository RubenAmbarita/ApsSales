@extends('layouts.admin')


@section('content')
    <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Unit</h1>
                        <a href="{{route('stock.create')}}" class="btn btn-sm btn-primary shadow-sm">
                            <i class="fas fa-plus fa-sm text-white-50"></i>Tambah Unit
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
                            <form action="{{route('stock.store')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="id_tower">Tower</label>
                                    <select name="id_tower" required class="form-control">
                                        <option value="">Pilih Tower</option>
                                        @foreach($towers as $tower)
                                            <option value="{{$tower->id}}">
                                                {{ $tower->tower_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="unit">Nama Unit</label>
                                    <input type="unit" class="form-control" name="unit" placeholder="Unit" value="{{old('unit')}}">
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" required class="form-control">
                                        <option value="READY">Ready</option>
                                        <option value="ONPROCESS">Onprocess</option>
                                        <option value="SOLD">Sold</option>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label for="price">Harga Unit</label>
                                    <input type="text" class="form-control" name="price" placeholder="Harga Unit" value="{{old('price')}}">
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