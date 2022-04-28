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
      <button type="button" class="btn bg-maroon" data-toggle="modal" data-target="#exampleModal">
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
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
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
            <div class="modal-footer form-group">
                <button type="submit" class="btn btn-primary">Tambah Kategori</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
  <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  $('.data-productCategory').DataTable({
    processing:true,
    serverSide:true,
    ajax:"{{route('productCategory.productCategoryJson')}}",
    columns:[
      {data:"DT_RowIndex",name:"DT_RowIndex"},
      {data:"category_name",name:"category_name"},
      {
        data:"id_product_category",
        render: function(data,type,row){
          return '<a href="/product_category/edit/'+data+'" class="btn btn-warning"><i class="fas fa-edit"></i></a> <a href="/product_category/edit/'+data+'" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>';
        }
      }
      // {
      //   data:"image",
      //   name:"image",
      //   render: function(data,type,row){
      //     return '<img src="img/product/'+data+'">';
      //   }
      // },
      // {data:"productCategory",name:"productCategory.category_name"},
      // {
      //   data:"image",
      //   render: function(data,type,row){
      //     return '<a href="#" class="btn btn-danger"><i class="fas fa-pencil-alt"></i></a>';
      //   }
      // }
    ]
  });
});
</script>