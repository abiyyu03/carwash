@extends('layouts.master')
@section('breadcrumb')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Daftarkan Akun</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Dashboard v1</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
@endsection
@section('content')
<div class="container-fluid">
<div class="card">
    <div class="card-body">
    @if($message = Session::get('success'))
        <div class="alert alert-success">
            <p>
              <i class="fas fa-check"></i>
              {{$message}}
            </p>
        </div>
    @endif
        <form action="{{route('registers.register')}}" method="post">
          @csrf
            <div class="form-group">
                <label for="customer_name">Nama Lengkap</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="role_id">Role</label>
                <select name="role_id" class="form-control" required>
                  <option>-</option>
                  @foreach($role_data as $role)
                  <option value="{{$role->id_role}}">{{$role->role_name}}</option>
                  @endforeach
                </select>
            </div>
            <div class="form-group d-flex justify-content-end">
                <button class="bg-maroon btn" type="submit">Daftarkan</button>
            </div>
        </form>
    </div>
</div>
</div>
@endsection