@extends('layouts.master')

@section('breadcrumb')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Kategori Produk</h1>
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
<div class="container-fluid">
    <div class=" d-flex justify-content-end">
      <button type="button" class="btn bg-info" data-toggle="modal" data-target="#exampleModal">
          <i class="fas fa-plus"></i>
          Tambah Kategori Produk
      </button>
    </div>
    <div class="card mt-3">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table data-productCategory">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nama Kategori</th>
                  <th>Tipe Produk</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach($productCategory_data as $productCategory)
                  <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$productCategory->category_name}}</td>
                    <td>{{$productCategory->productType->product_type}}</td>
                    <td><a href="{{$productCategory->id_product_category}}" id="editButton" data-toggle="modal" data-target="#editModal" class="btn btn-warning" data="{{$productCategory->id_product_category}}"><i class="fas fa-edit"></i> Edit</a> 
                    <a href="/product-category/delete/{{$productCategory->id_product_category}}" id="deleteButton" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Delete</a></td>
                  </tr>
                @endforeach
              </tbody>
              </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori Produk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{route('product_category.store')}}">
          @csrf
            <div class="form-group">
                <label for="category_name" class="col-form-label">Nama Kategori Produk</label>
                <input type="text" class="form-control" id="category_name" name="category_name" required>
            </div>
            <div class="form-group">
                <label for="product_type_id" class="col-form-label">Tipe Produk</label>
                <select name="product_type_id" class="form-control" required>
                  <option selected disabled>-</option>
                  @foreach($productType_data as $productType)
                  <option value="{{$productType->id_product_type}}">{{$productType->product_type}}</option>
                  @endforeach
                </select>
            </div>
            <div class="modal-footer form-group">
                <button type="submit" class="btn btn-info">Tambah Kategori</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- modal edit -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Kategori Produk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="" id="editForm">
          @csrf
          {{method_field('PUT')}}
            <div class="form-group">
                <label for="category_name" class="col-form-label">Nama Kategori Produk</label>
                <input type="text" class="form-control" id="edit_category_name" name="category_name" required>
            </div>
            <div class="form-group">
                <label for="product_type_id" class="col-form-label">Tipe Produk</label>
                <select name="product_type_id" class="form-control" id="edit_product_type_id" required>
                  <option disabled>-</option>
                  @foreach($productType_data as $productType)
                  <option value="{{$productType->id_product_type}}">{{$productType->product_type}}</option>
                  @endforeach
                </select>
            </div>
            <div class="modal-footer form-group">
                <button type="submit" class="btn btn-info">Edit Kategori</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script src="{{ asset('js/productCategory.min.js') }}"></script>
@endsection
<script>
  $(document).ready(function(){
    $('#deleteButton').on("click",function(event){
    event.preventDefault();
    var url = $(this).attr('href');
    console.log(url);
    swal.fire({
      title: 'Apakah Kamu yakin ingin menghapus data ini ?',
      text: "Data yang terhapus tidak bisa di kembalikan!",
      icon: 'warning',
      // buttons: ["Cancel","Yakin!"],
      showCancelButton: true,
      // confirmButtonColor: '#3085d6',
      // cancelButtonColor: '#d33',
      confirmButtonText: 'Yakin !'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = url;
        }
    });
  });
  })
</script>