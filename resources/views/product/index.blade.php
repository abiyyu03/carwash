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
      <button type="button" class="btn bg-info" data-toggle="modal" data-target="#exampleModal">
          <i class="fas fa-plus"></i>
          Tambah Produk
      </button>
  </div>
  <div class="card card-body mt-3">
    <div class="d-flex justify-content-between">
      <div class="as">
        asd
      </div>
      <div class="">
        <select name="product_category_id" id="product_category_id" class="form-control" required>
          <option disabled>-</option>
          @foreach($productCategory_data as $productCategory)
            <option value="{{$productCategory->id_product_category}}" >{{$productCategory->category_name}}</option>
          @endforeach
        </select>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table data-product">
          <thead>
            <tr>
              <th>#</th>
              <th>Nama Produk</th>
              <th>Kode Produk</th>
              <th>Harga Produk</th>
              <th>Harga Modal</th>
              <th>Stok Produk</th>
              <th>Stok Minimal Produk</th>
              <th>Diskon (%)</th>
              <th>Kategori Produk</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($product_data as $product)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $product->product_name }}</td>
              <td>{{ $product->product_code }}</td>
              <td>{{ $product->product_price }}</td>
              <td>{{ $product->product_capital_price }}</td>
              <td>{{ $product->product_stock }}</td>
              <td>{{ $product->product_minimum_stock }}</td>
              <td>{{ $product->product_discount }}</td>
              <!-- <td><a href="#" id="detailImage" data-toggle="modal" class="btn btn-primary" data-target="#detailModal" data-product-image="{{ $product->product_image }}"><i class="fas fa-image"></i> Tampilkan</a></td> -->
              <td>{{ $product->productCategory->category_name }}</td>
              <td><!-- <a href="#" id="detailButton" class="btn btn-primary"><i class="fas fa-info-circle"></i> Detail</a> -->
              <a href="#" id="percentageButton" data-toggle="modal" data-target="#percentageModal" class="btn btn-primary"><i class="fas fa-percentage"></i> Diskon</a> 
              <a href="#" id="editButton" data-toggle="modal" data-target="#editModal" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a> 
              <a href="/product/delete/{{ $product->id_product }}" id="deleteButton" class="btn btn-danger deleteButton"><i class="fas fa-trash-alt"></i> Delete</a> </td>
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
            <!-- <div class="form-group">
              <label for="product_code" class="col-form-label">Kode Produk</label>
              <input type="text" class="form-control" id="product_code" value="{{old('product_code')}}" name="product_code" required>
            </div> -->
            <div class="form-group">
              <label for="product_price" class="col-form-label">Harga Jual</label>
              <input type="number" class="form-control" id="product_price" value="{{old('product_price')}}" name="product_price" required>
            </div>
            <div class="form-group">
              <label for="product_capital_price" class="col-form-label">Harga Beli</label>
              <input type="number" class="form-control" id="product_capital_price" value="{{old('product_capital_price')}}" name="product_capital_price" required>
            </div>
            <div class="form-group">
              <label for="product_stock" class="col-form-label">Jumlah Stok</label>
              <input type="number" class="form-control" id="product_stock" value="{{old('product_stock')}}" name="product_stock" required>
            </div>
            <div class="form-group">
              <label for="product_minimum_stock" class="col-form-label">Minimal Stok</label>
              <input type="number" class="form-control" id="product_minimum_stock" value="{{old('product_minimum_stock')}}" name="product_minimum_stock" required>
            </div>
            <!-- <div class="form-group">
              <label for="image" class="col-form-label">Gambar Produk</label>
              <input type="file" class="form-control" id="product_image" value="{{old('product_image')}}" name="product_image">
            </div> -->
            <div class="form-group">
                <label for="product_category_id">Kategori Produk</label>
                <select name="product_category_id" class="form-control" required>
                  <option disabled>-</option>
                  @foreach($productCategory_data as $productCategory)
                  <option value="{{$productCategory->id_product_category}}">{{$productCategory->category_name}}</option>
                  @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="inventory_id">Penggunaan Inventori</label>
                <select name="inventory_id[]" id="inventory_id" class="form-control" style="width:100%" multiple>
                  <option disabled value="">-</option>
                  @foreach($inventory_data as $inventory)
                  <option value="{{$inventory->id_inventory}}">{{$inventory->inventory_name}}</option>
                  @endforeach
                </select>
            </div>
            <div class="modal-footer form-group">
              <button type="submit" class="btn btn-info">Tambah Produk</button>
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
          <h5 class="modal-title" id="exampleModalLabel">Edit Produk</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="" method="POST" id="editForm">
            @csrf
            {{method_field('PUT')}}
            <div class="form-group">
              <label for="product_name" class="col-form-label">Nama Produk</label>
              <input type="text" class="form-control" id="edit_product_name" name="product_name">
            </div>
            <div class="form-group">
              <label for="product_price" class="col-form-label">Harga Jual</label>
              <input type="number" class="form-control" id="edit_product_price" name="product_price" required>
            </div>
            <div class="form-group">
              <label for="product_capital_price" class="col-form-label">Harga Beli</label>
              <input type="number" class="form-control" id="edit_product_capital_price" name="product_capital_price" required>
            </div>
            <div class="form-group">
              <label for="product_stock" class="col-form-label">Jumlah Stok</label>
              <input type="number" class="form-control" id="edit_product_stock" name="product_stock" required>
            </div>
            <div class="form-group">
              <label for="product_minimum_stock" class="col-form-label">Minimal Stok</label>
              <input type="number" class="form-control" id="edit_product_minimum_stock" name="product_minimum_stock" required>
            </div>
            <!-- <div class="form-group">
              <label for="product_discount" class="col-form-label">Diskon (Opsional)</label>
              <input type="number" class="form-control" id="edit_product_discount" name="product_discount">
            </div> -->
            <!-- <div class="form-group">
              <label for="image" class="col-form-label">Gambar Produk</label>
              <input type="file" class="form-control" id="edit_product_image" value="{{old('product_image')}}" name="product_image">
            </div> -->
            <div class="form-group">
                <label for="product_category_id">Kategori Produk</label>
                <select name="product_category_id" id="edit_product_category_id" class="form-control" required>
                  <option disabled value="">-</option>
                  @foreach($productCategory_data as $productCategory)
                  <option value="{{$productCategory->id_product_category}}">{{$productCategory->category_name}}</option>
                  @endforeach
                </select>
            </div>
            <div class="modal-footer form-group">
              <button type="submit" class="btn btn-info">Edit Produk</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="percentageModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Buat Diskon</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="" method="POST" id="percentageForm">
            @csrf
            {{method_field('PUT')}}
            <input type="hidden" class="form-control disabled" id="percentage_product_price" name="product_price" readonly>
            <div class="form-group">
              <label for="product_discount" class="col-form-label">Diskon</label>
              <input type="number" class="form-control" min=0 id="percentage_product_discount" name="product_discount">
            </div>
            <div class="modal-footer form-group">
              <button type="submit" class="btn btn-info">Atur Diskon</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@push('addon-scripts')
<script type="text/javascript">
$(document).ready(function(){
  // $('.data-product').DataTable({
  //   processing:true,
  //   serverSide:true,
  //   ajax:"{{route('product.productJson')}}",
  //   columns:[
  //     // {data:"DT_Row_Index",name:"DT_Row_Index", orderable:false, searchable:false},
  //     {data:"DT_RowIndex",name:"DT_RowIndex", orderable:false, searchable:false},
  //     {data:"product_name",name:"product_name"},
  //     {data:"product_code",name:"product_code"},
  //     // {data:"product_price",name:"product_price"},
  //     {data:"product_stock",name:"product_stock"},
  //     // {
  //     //   data:"product_image",
  //     //   name:"product_image",
  //     //   render: function(data,type,row){
  //     //     return '<img src="img/product/'+data+'">';
  //     //   }
  //     // },
  //     {data:"productCategory",name:"productCategory.category_name"},
  //     {
  //       data:"id_product",
  //       render: function(data,type,row){
  //         return '<a href="/employee/detail/'+data+'" class="btn btn-primary"><i class="fas fa-info-circle"></i> Detail</a> <a href="#" id="editButton" data-toggle="modal" data-target="#editModal" class="btn btn-warning" data-id="'+data+'"><i class="fas fa-edit"></i> Edit</a> <a href="/product/delete/'+data+'" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Delete</a> ';
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

  var table = $('.data-product').DataTable();
  // $('#editButton').on("click",function(){
  table.on("click",'#editButton',function(){
    $tr = $(this).closest('tr');
    if($($tr).hasClass('child')){
      $tr = $tr.prev('.parent');
    }

    var data = table.row($tr).data();
    console.log(data);

    $('#edit_product_name').val(data[1]);
    $('#edit_product_code').val(data[2]);
    $('#edit_product_price').val(data[3]);
    $('#edit_product_capital_price').val(data[4]);
    $('#edit_product_stock').val(data[5]);
    $('#edit_product_minimum_stock').val(data[6]);
    // $('#edit_product_discount').val(data[7]);
    $('#edit_product_category_id option:selected').val(data[8]);
    $('#editForm').attr('action','product/update/'+data[0]);
    $('#editModal').modal('show');

  });

  table.on("click",'#percentageButton',function(){
    $tr = $(this).closest('tr');
    if($($tr).hasClass('child')){
      $tr = $tr.prev('.parent');
    }

    var data = table.row($tr).data();
    $('#percentage_product_price').val(data[3]);
    $('#percentage_product_discount').val(data[7]);
    $('#percentageForm').attr('action','product/discount/create/'+data[0]);
    $('#percentageModal').modal('show');

  });

  $('#inventory_id').select2();

  table.on('preXhr.dt',function(e,settings,data){
      data.product_category_id = $('#product_category_id').val(); 
  });
  $('#product_category_id').change(function(){
    table.DataTable().ajax.reload();
    return false;
  });
});
</script>
@endpush