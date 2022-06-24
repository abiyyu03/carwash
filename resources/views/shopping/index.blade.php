@extends('layouts.master')

@section('breadcrumb')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Belanja Produk / Inventory</h1>
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
        <table class="table data-inventoryDetail">
          <thead>
            <tr>
              <th>#</th>
              <th>Nama Barang</th>
              <th>Harga Barang</th>
              <th>Jumlah Barang</th>
              <th>Nama Item / Produk</th>
              <th>Nama / Nama Toko</th>
              <th>Kontak Toko</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($inventoryDetail_data as $inventoryDetail)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $inventoryDetail->inventory_detail_name }}</td>
              <td>{{ $inventoryDetail->inventory_detail_price }}</td>
              <td>{{ $inventoryDetail->inventory_detail_amount }}</td>
              <td>{{ ($inventoryDetail->inventory != NULL) ? @$inventoryDetail->inventory->inventory_name : @$inventoryDetail->product->product_name }}</td>
              <td>{{ $inventoryDetail->supplier_name }}</td>
              <td>{{ $inventoryDetail->supplier_contact }}</td>
              <td>
                <a href="#" id="editButton" data-toggle="modal" data-target="#editModal" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a> 
                <a href="/supplier/delete/{{ $inventoryDetail->id_inventory_detail }}" id="deleteButton" class="btn btn-danger deleteButton"><i class="fas fa-trash-alt"></i> Delete</a> 
              </td>
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
          <form action="{{route('inventoryDetail.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            {{-- <div class="form-group">
              <label for="supplier_name" class="col-form-label">Nama Supplier / Toko <sup class="text-danger">*</sup></label>
              <input type="text" class="form-control" id="supplier_name" value="{{old('supplier_name')}}" name="supplier_name" required>
            </div> --}}
            <div class="form-group">
              <label for="inventory_detail_name" class="col-form-label">Nama Barang</label>
              <input type="text" class="form-control" id="inventory_detail_name" value="{{old('inventory_detail_name')}}" name="inventory_detail_name" required>
            </div>
            <div class="form-group">
              <label for="inventory_detail_amount" class="col-form-label">Jumlah Barang</label>
              <input type="text" class="form-control" id="inventory_detail_amount" value="{{old('inventory_detail_amount')}}" name="inventory_detail_amount" required>
            </div>
            <div class="form-group">
              <label for="inventory_detail_price" class="col-form-label">Harga Barang</label>
              <input type="number" class="form-control" id="inventory_detail_price" value="{{old('inventory_detail_price')}}" name="inventory_detail_price" required>
            </div>
            <div class="form-group">
              <label for="inventory_id" class="col-form-label">Nama Inventory</label>
              <select name="inventory_id" id="" class="form-control">
                <option value="">-</option>
                @foreach($inventory_data as $item)
                  <option value="{{ $item->id_inventory }}">{{ $item->inventory_name }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="product_id" class="col-form-label">Nama Produk</label>
              <select name="product_id" id="" class="form-control">
                <option value="">-</option>
                @foreach($product_data as $product)
                  <option value="{{ $product->id_product }}">{{ $product->product_name }}</option>
                @endforeach
              </select>
            </div>
            {{-- <div class="form-group">
              <label for="supplier_contact" class="col-form-label">Kontak Supplier</label>
              <input type="text" class="form-control" id="supplier_contact" name="supplier_contact">{{old('supplier_contact')}}</textarea>
            </div> --}}
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
              <label for="supplier_name" class="col-form-label">Nama Supplier / Toko</label>
              <input type="text" class="form-control" id="edit_supplier_name" value="{{old('supplier_name')}}" name="supplier_name" required>
            </div>
            <div class="form-group">
              <label for="inventory_detail_name" class="col-form-label">Nama Barang</label>
              <input type="text" class="form-control" id="edit_inventory_detail_name" value="{{old('inventory_detail_name')}}" name="inventory_detail_name" required>
            </div>
            <div class="form-group">
              <label for="inventory_detail_amount" class="col-form-label">Jumlah Barang</label>
              <input type="text" class="form-control" id="edit_inventory_detail_amount" value="{{old('inventory_detail_amount')}}" name="inventory_detail_amount" required>
            </div>
            <div class="form-group">
              <label for="inventory_detail_price" class="col-form-label">Harga Barang</label>
              <input type="number" class="form-control" id="edit_inventory_detail_price" value="{{old('inventory_detail_price')}}" name="inventory_detail_price" required>
            </div>
            <div class="form-group">
              <label for="supplier_contact" class="col-form-label">Kontak Supplier</label>
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
<!-- <script src="{{ asset('js/supplier.min.js') }}"></script> -->
@endsection
@push('addon-scripts')
<script>
  $(document).ready(function(){
    $('.data-supplier').DataTable();
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
    
    var table = $('.data-inventoryDetail').DataTable();
    table.on("click",'#editButton',function(){
        $tr = $(this).closest('tr');
        if($($tr).hasClass('child')){
            $tr = $tr.prev('.parent');
        }
        
        var data = table.row($tr).data();
        // console.log(data);
        
        $('#edit_inventory_detail_name').val(data[1]);
        $('#edit_inventory_detail_price').val(data[2]);
        $('#edit_inventory_detail_amount').val(data[3]);
        $('#edit_supplier_name').val(data[5]);
        $('#edit_supplier_contact').val(data[6]);
        $('#editForm').attr('action','shopping/update/'+data[0]);
        $('#editModal').modal('show');
        
    });
  });
</script>
@endpush