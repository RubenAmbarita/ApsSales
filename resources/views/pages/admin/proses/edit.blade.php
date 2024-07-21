@extends('layouts.admin')


@section('content')
    <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Boking Unit</h1>
                        <a href="#" class="btn btn-sm btn-primary shadow-sm">
                            <i class="fas fa-sm text-white-50"></i> Boking Unit {{$item->unit}}
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
                            <form action="{{route('proses.update', $item->id)}}" method="post">
                                @method('PUT')
                                @csrf
                                <div class="form-group">
                                    <label for="id_tower">Tower</label>
                                    <select name="id_tower" required class="form-control" disabled>
                                        <option value="">Pilih Tower</option>
                                        <option value="{{$item->id_tower}}" selected>{{ $item->tower->tower_name }}</option>
                                        @foreach($towers as $tower)
                                            <option value="{{$tower->id}}">
                                                {{ $tower->tower_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="id_sales">Sales</label>
                                    <select name="id_sales" class="form-control" {{ $item->status == 'ONPROCESS' ? 'disabled' : '' }}>
                                        @if($item->status == 'ONPROCESS')
                                        <option value="{{$item->id_sales}}" >{{$item->user->name}}</option>
                                        @else
                                        <option value="" >Pilih Sales</option>
                                        @endif
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}">
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="unit">Nama Unit</label>
                                    <input type="unit" class="form-control" name="unit" placeholder="Unit" value="{{$item->unit}}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" required class="form-control">
                                        <option value="ONPROCESS">Onprocess</option>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label for="price">Harga Unit</label>
                                    <input type="text" class="form-control" name="price" id="price" placeholder="Harga Unit" value="{{$item->price}}" disabled>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">
                                    Booking Unit
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
@endsection