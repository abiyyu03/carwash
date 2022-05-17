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
                    <a href="/product_category/edit/{{$productCategory->id_product_category}}" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Delete</a></td>
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
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script>
  $(document).ready(function(){
  var table = $('.data-productCategory').DataTable();
  // $('#editButton').on("click",function(){
  table.on("click",'#editButton',function(){
    $tr = $(this).closest('tr');
    if($($tr).hasClass('child')){
      $tr = $tr.prev('.parent');
    }

    var data = table.row($tr).data();
    console.log(data);

    $('#edit_category_name').val(data[1]);
    $('#edit_product_type_id ').val(data[0]);
    $('#editForm').attr('action','product_category/update/'+data[0]);
    $('#editModal').modal('show');
    
    // var id = $(this).attr('data');
    // console.log(id);
    // $.ajax({
    //   url:"/product_category/edit/"+id,
    //   type:"GET",
    //   dataType:"JSON",
    //   // data: [
    //   //   id:id_product_category,
    //   //   category_name:category_name,
    //   //   product_type_id:product_type_id
    //   // ],
    //   success: function (data) {
    //     console.log(data);
    //     $('#edit_category_name').val(data.category_name);
    //     $('#edit_product_type_id').val(data.product_type_id);
    //   }
    // });
});
});
</script>
<script type="text/javascript">
  $(document).ready(function(){
  // $('.data-productCategory').DataTable({
  //   processing:true,
  //   serverSide:true,
  //   ajax:"{{route('productCategory.productCategoryJson')}}",
  //   columns:[
  //     {data:"DT_RowIndex",name:"DT_RowIndex"},
  //     {data:"category_name",name:"category_name"},
  //     // {data:"productType.product_type",name:"productType.product_type"},
  //     {
  //       data:"id_product_category",
  //       render: function(data,type,row){
  //         return '<a href="#" id="editButton" data-toggle="modal" data-target="#editModal" class="btn btn-warning" data-id="'+data+'"><i class="fas fa-edit"></i> Edit</a> <a href="/product_category/edit/'+data+'" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Delete</a>';
  //       }
  //     }
  //   ]
  // });
});
</script>