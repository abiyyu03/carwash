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
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <form action="">
                <div class="form-group">
                <label for="vehicle_type_id">Kategori</label>
                <select name="vehicle_type_id" class="form-control">
                <option value="">Lambhorgini</option>
                </select>
            </div>
            <div class="form-group">
                <label for="vehicle_type_id">Kategori produk</label>
                <select name="vehicle_type_id" class="form-control">
                <option value="">Lambhorgini</option>
                </select>
            </div>
            <div class="form-group">
                <label for="vehicle_type_id">Jumlah Produk</label>
                <input name="vehicle_type_id" type="number"min="1" class="form-control">
                
                
            </div>
                <div class="form-group">
                <a href="" class="btn bg-maroon ml-2">Tambah</a>
                </div>
                </form>
            </div>
        </div>

    </div>
    <div class="col-md-8">
    <div class="card">
    <div class="card-body">
        Halaman Transaksi
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Jumlah Produk</th>
                        <th>Harga Satuan </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Air Mineral</td>
                        <td>5</td>
                        <td>3000</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body d-flex justify-content-end">
       <h3>Total: Rp.6000</h3>
        <a href="" class="btn bg-maroon ml-2">Proses</a>
    </div>
</div>
</div>
    </div>
</div>
</div>
@endsection