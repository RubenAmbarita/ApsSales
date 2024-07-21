@extends('layouts.admin')


@section('content')
    <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">User</h1>
                        <a href="#" class="btn btn-sm btn-primary shadow-sm">
                            <i class="fas fa-sm text-white-50"></i> Edit User {{$item->name}}
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
                            <form action="{{route('user.update', $item->id)}}" method="post">
                                @method('PUT')
                                @csrf
                                <div class="form-group">
                                    <label for="name">Nama User</label>
                                    <input type="text" class="form-control" name="name" placeholder="Nama User" value="{{$item->name}}">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email" placeholder="Email" value="{{$item->email}}">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" name="password" placeholder="Password">
                                    <small>Kosongkan jika tidak ingin mengganti password</small>
                                </div>
                                <div class="form-group">
                                    <label for="roles">Roles</label>
                                    <select name="roles" required class="form-control">
                                        <option value="{{$item->roles}}" selected>Tidak diganti</option>
                                        <option value="ADMIN">Admin</option>
                                        <option value="SALES">Sales</option>
                                        <option value="MANAGER">Manager</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">
                                    Ubah
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
@endsection