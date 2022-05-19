@extends('layouts.master')

@section('breadcrumb')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Supplier</h1>
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
      <button type="button" class="btn bg-info" data-toggle="modal" data-target="#exampleModal">
          <i class="fas fa-plus"></i>
          Tambah Produk
      </button>
  </div>
  <div class="card mt-3">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table data-supplier">
          <thead>
            <tr>
              <th>#</th>
              <th>Nama / Nama Toko</th>
              <th>Alamat</th>
              <th>Kontak</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($supplier_data as $supplier)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $supplier->supplier_name }}</td>
              <td>{{ $supplier->supplier_address }}</td>
              <td>{{ $supplier->supplier_contact }}</td>
              <td><a href="#" id="editButton" data-toggle="modal" data-target="#editModal" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a> 
                    <a href="/supplier/delete/{{ $supplier->id_supplier }}" id="deleteButton" class="btn btn-danger deleteButton"><i class="fas fa-trash-alt"></i> Delete</a> </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Supplier</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{route('supplier.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="supplier_name" class="col-form-label">Nama Supplier / Toko <sup class="text-danger">*</sup></label>
              <input type="text" class="form-control" id="supplier_name" value="{{old('supplier_name')}}" name="supplier_name" required>
            </div>
            <div class="form-group">
              <label for="supplier_address" class="col-form-label">Alamat Supplier <sup class="text-danger">*</sup></label>
              <input type="text" class="form-control" id="supplier_address" value="{{old('supplier_address')}}" name="supplier_address" required>
            </div>
            <div class="form-group">
              <label for="supplier_contact" class="col-form-label">Kontak Supplier <sup class="text-danger">*</sup></label>
              <input type="text" class="form-control" id="supplier_contact" name="supplier_contact">{{old('supplier_contact')}}</textarea>
            </div>
            <div class="modal-footer form-group">
              <button type="submit" class="btn btn-info">Tambah Supplier</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- edit data -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Supplier</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="" method="POST" id="editForm">
            @csrf
            {{method_field('PUT')}}
            <div class="form-group">
              <label for="supplier_name" class="col-form-label">Nama Supplier / Toko <sup class="text-danger">*</sup></label>
              <input type="text" class="form-control" id="edit_supplier_name" value="{{old('supplier_name')}}" name="supplier_name" required>
            </div>
            <div class="form-group">
              <label for="supplier_address" class="col-form-label">Alamat Supplier <sup class="text-danger">*</sup></label>
              <input type="text" class="form-control" id="edit_supplier_address" value="{{old('supplier_address')}}" name="supplier_address" required>
            </div>
            <div class="form-group">
              <label for="supplier_contact" class="col-form-label">Kontak Supplier <sup class="text-danger">*</sup></label>
              <input type="text" class="form-control" id="edit_supplier_contact" name="supplier_contact">{{old('supplier_contact')}}</textarea>
            </div>
            <div class="modal-footer form-group">
              <button type="submit" class="btn btn-info">Edit Supplier</button>
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
  $('.data-supplier').DataTable();
  //   processing:true,
  //   serverSide:true,
  //   ajax:"{{route('product.productJson')}}",
  //   columns:[
  //     // {data:"DT_Row_Index",name:"DT_Row_Index", orderable:false, searchable:false},
  //     {data:"DT_RowIndex",name:"DT_RowIndex", orderable:false, searchable:false},
  //     {data:"product_name",name:"product_name"},
  //     {data:"product_code",name:"product_code"},
  //     {data:"product_price",name:"product_price"},
  //     {data:"product_stock",name:"product_stock"},
  //     {
  //       data:"image",
  //       name:"image",
  //       render: function(data,type,row){
  //         return '<img src="img/product/'+data+'">';
  //       }
  //     },
  //     {data:"productCategory",name:"productCategory.category_name"},
  //     {
  //       render: function(data,type,row){
  //         return '<a href="#" class="btn btn-danger"><i class="fas fa-pencil-alt"></i></a>';
  //       }
  //     }
  //   ]
  // });
  $('.deleteButton').on("click",function(event){
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

  var table = $('.data-supplier').DataTable();
  // $('#editButton').on("click",function(){
  table.on("click",'#editButton',function(){
    $tr = $(this).closest('tr');
    if($($tr).hasClass('child')){
      $tr = $tr.prev('.parent');
    }

    var data = table.row($tr).data();
    // console.log(data);

    $('#edit_supplier_name').val(data[1]);
    $('#edit_supplier_address').val(data[2]);
    $('#edit_supplier_contact').val(data[3]);
    // $('#edit_product_category_id').val(data[6]);
    $('#editForm').attr('action','supplier/update/'+data[0]);
    $('#editModal').modal('show');

  });
});
</script>