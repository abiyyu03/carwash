@extends('layouts.master')

@section('breadcrumb')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Produk</h1>
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
  @if($message = Session::get('success'))
      <div class="alert alert-success">
          <p>
            <i class="fas fa-check"></i>
             {{$message}}
          </p>
      </div>
  @endif
  <div class=" d-flex justify-content-end">
      <button type="button" class="btn bg-maroon" data-toggle="modal" data-target="#exampleModal">
          <i class="fas fa-plus"></i>
          Tambah Produk
      </button>
  </div>
  <div class="card mt-3">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table data-product">
          <thead>
            <tr>
              <th>#</th>
              <th>Nama Produk</th>
              <th>Kode Produk</th>
              <th>Harga Produk</th>
              <th>Stok Produk</th>
              <th>Gambar Produk</th>
              <th>Kategori Produk</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
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
          <form action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="product_name" class="col-form-label">Nama Produk</label>
              <input type="text" class="form-control" id="product_name" value="{{old('product_name')}}" name="product_name">
            </div>
            <div class="form-group">
              <label for="product_code" class="col-form-label">Kode Produk</label>
              <input type="text" class="form-control" id="product_code" value="{{old('product_code')}}" name="product_code" required>
            </div>
            <div class="form-group">
              <label for="message-text" class="col-form-label">Deskripsi Produk</label>
              <textarea class="form-control" id="product_description" name="product_description" required>{{old('product_description')}}</textarea>
            </div>
            <div class="form-group">
              <label for="product_price" class="col-form-label">Harga Produk</label>
              <input type="number" class="form-control" id="product_price" value="{{old('product_price')}}" name="product_price" required>
            </div>
            <div class="form-group">
              <label for="product_stock" class="col-form-label">Jumlah Stok</label>
              <input type="number" class="form-control" id="product_stock" value="{{old('product_stock')}}" name="product_stock" required>
            </div>
            <div class="form-group">
              <label for="image" class="col-form-label">Gambar Produk</label>
              <input type="file" class="form-control" id="image" value="{{old('image')}}" name="image" required>
            </div>
            <div class="form-group">
                <label for="product_category_id">Kategori Produk</label>
                <select name="product_category_id" class="form-control" required>
                  <option>-</option>
                  @foreach($productCategory_data as $productCategory)
                  <option value="{{$productCategory->id}}">{{$productCategory->category_name}}</option>
                  @endforeach
                </select>
            </div>
            <!-- <div class="form-group">
              <label for="recipient-name" class="col-form-label">Supplier</label>
              <input type="number" class="form-control" id="supplier_id" name="supplier_id" required>
            </div> -->
            <div class="modal-footer form-group">
              <button type="submit" class="btn btn-primary">Tambah Produk</button>
            </div>
          </form>
        </div>
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
  $('.data-product').DataTable({
    processing:true,
    serverSide:true,
    ajax:"{{route('product.productJson')}}",
    columns:[
      // {data:"DT_Row_Index",name:"DT_Row_Index", orderable:false, searchable:false},
      {data:"DT_RowIndex",name:"DT_RowIndex", orderable:false, searchable:false},
      {data:"product_name",name:"product_name"},
      {data:"product_code",name:"product_code"},
      {data:"product_price",name:"product_price"},
      {data:"product_stock",name:"product_stock"},
      {
        data:"image",
        name:"image",
        render: function(data,type,row){
          return '<img src="img/product/'+data+'">';
        }
      },
      {data:"productCategory",name:"productCategory.category_name"},
      {
        render: function(data,type,row){
          return '<a href="#" class="btn btn-danger"><i class="fas fa-pencil-alt"></i></a>';
        }
      }
    ]
  });
});
</script>