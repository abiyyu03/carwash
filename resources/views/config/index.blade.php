@extends('layouts.master')

@section('breadcrumb')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Pengaturan</h1>
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
  <div class="row">
      <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-info">
                <h2 class="card-title" ><i class="fas fa-users"></i> Pengaturan Akun</h2>
            </div>
            <div class="card-body">
                <form action="{{route('user.update',Auth()->user()->id_user)}}" method="POST">
                    @csrf
                    {{method_field('PUT')}}
                    <div class="form-group">
                        <label for="customer_name">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ Auth()->user()->name }}" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" disabled name="email" value="{{ Auth()->user()->email }}" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="form-group d-flex justify-content-end">
                        <button class="bg-info btn" type="submit"><i class="fas fa-check"></i> Perbarui</button>
                    </div>
                </form>
            </div>
        </div>
      </div>
      <!-- <div class="col-md-6">
      <div class="card">
            <div class="card-header bg-info">
                <h2 class="card-title" ><i class="fas fa-palette"></i> Tampilan Aplikasi</h2>
            </div>
            <div class="card-body">
                <form action="{{route('registers.register')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="customer_name">Palet Warna</label>
                        <select name="" id="" class="form-control">
                          <option value="info">Hijau Toska</option>
                        </select>
                    </div>
                    <div class="form-group d-flex justify-content-end">
                        <button class="bg-info btn" type="submit"><i class="fas fa-check"></i> Ubah</button>
                    </div>
                </form>
            </div>
        </div>
      </div> -->
  </div>
</div>
@endsection
<script>
  //store item to localstorage
  localStorage.setItem("theme","navy");

  //get item on localstorage
  document.getElementById("element").innerHTML = localStorage.getItem("theme");
</script>
