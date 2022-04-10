@extends('layouts.master')
@section('breadcrumb')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Dashboard</h1>
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
<div class="container-fluid ">
<div class="card">
    <div class="card-body">
        <form action="" method="post">
            <div class="form-group">
                <label for="customer_name">Nama Customer</label>
                <input type="text" name="customer_name" class="form-control">
            </div>
            <div class="form-group">
                <label for="customer_contact">Nomor Customer</label>
                <input type="text" name="customer_contact" class="form-control">
            </div>
            <div class="form-group">
                <label for="vehicle_name">Series Kendaraan</label>
                <input type="text" name="vehicle_name" class="form-control">
            </div>
            <div class="form-group">
                <label for="vehicle_registration_plate">Plat Nomor Kendaraan</label>
                <input type="text" name="vehicle_registration_plate" class="form-control">
            </div>
            <div class="form-group">
                <label for="vehicle_type_id">Type Kendaraan</label>
                <select name="vehicle_type_id" class="form-control">
                <option value="">Lambhorgini</option>
                </select>
            </div>
            <div class="form-group">
                <!-- <button class="bg-maroon btn " type="submit">Simpan dan lanjutkan </button> -->
                <a href="/transaction2" class="btn bg-maroon">Simpan dan lanjutkan</a>
            </div>
            
        </form>
    </div>
</div>
</div>
@endsection