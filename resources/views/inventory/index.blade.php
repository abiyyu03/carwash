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
<div class="container-fluid">
  <div class=" d-flex justify-content-end">
      <button type="button" class="btn bg-maroon" data-toggle="modal" data-target="#exampleModal">
          <i class="fas fa-plus"></i>
          Tambah Invetory
      </button>
    </div>
    <div class="card mt-3">
        <div class="card-body">
            <h1>asdasd</h1>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Tipe Kendaraan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{route('vehicle_type.store')}}">
          @csrf
            <div class="form-group">
                <label for="vehicle_type" class="col-form-label">Tipe Kendaraan</label>
                <input type="text" class="form-control" id="nama_product" name="vehicle_type" required>
            </div>
            <div class="modal-footer form-group">
                <button type="submit" class="btn btn-primary">Tambah Tipe</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection