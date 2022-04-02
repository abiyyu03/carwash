@extends('layouts.master')

@section('breadcrumb')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Daftar Karyawan</h1>
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
<!-- create data -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  <i class="fas fa-plus"></i>
  Tambah Data
</button>
<div class="card">
  <div class="card-body">
    <h1>asdasd</h1>
  </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Produk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Nama Produk</label>
            <input type="text" class="form-control" id="nama_product" name="nama_product" required>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Deskripsi Produk</label>
            <textarea class="form-control" id="description_product" name="description_product" required></textarea>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Stok</label>
            <input type="number" class="form-control" id="stock" name="stock" required>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Kategori Produk</label>
            <input type="number" class="form-control" id="category_product_id" name="category_product_id" required>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Supplier</label>
            <input type="number" class="form-control" id="supplier_id" name="supplier_id" required>
          </div>
          <div class="modal-footer form-group">
            <button type="submit" class="btn btn-primary">Tambah Produk</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection