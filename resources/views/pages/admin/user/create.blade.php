@extends('layouts.admin')


@section('content')
    <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">User</h1>
                        <a href="{{route('user.create')}}" class="btn btn-sm btn-primary shadow-sm">
                            <i class="fas fa-plus fa-sm text-white-50"></i>Tambah User
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
                            <form action="{{route('user.store')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Nama User</label>
                                    <input type="text" class="form-control" name="name" placeholder="Nama User" value="{{old('name')}}">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email" placeholder="Email" value="{{old('name')}}">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" name="password" placeholder="Password" value="{{old('password')}}">
                                </div>
                                <div class="form-group">
                                    <label for="roles">Roles</label>
                                    <select name="roles" required class="form-control">
                                        <option value="ADMIN">Admin</option>
                                        <option value="SALES">Sales</option>
                                        <option value="MANAGER">Manager</option>
                                    </select>
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