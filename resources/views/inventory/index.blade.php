@extends('layouts.master')
@section('breadcrumb')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Inventory</h1>
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
          Tambah Inventory
      </button>
    </div>
    <div class="card mt-3">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table data-inventory">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nama Barang</th>
                  <th>Jumlah Barang</th>
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
        <h5 class="modal-title" id="exampleModalLabel">Tambah Tipe Kendaraan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{route('inventory.store')}}">
          @csrf
            <div class="form-group">
                <label for="Item_name" class="col-form-label">Nama Barang</label>
                <input type="text" class="form-control" id="" name="inventory_name" required>
            </div>
            <!-- <div class="form-group">
                <label for="Item_code" class="col-form-label">Kode Barang</label>
                <input type="text" class="form-control" id="" name="item_code" required>
            </div> -->
            <div class="form-group">
                <label for="Item_stock" class="col-form-label">Jumlah Barang</label>
                <input type="text" class="form-control" id="" name="inventory_amount" required>
            </div>
            <!-- <div class="form-group">
                <label for="Item_dosage" class="col-form-label">Takaran Barang</label>
                <input type="number" class="form-control" id="" name="item_dosage" required>
            </div>
            <div class="form-group">
                <label for="Item_capital_price" class="col-form-label">Harga modal</label>
                <input type="number" class="form-control" id="" name="item_capital_price" required>
            </div>
            <div class="form-group">
                <label for="Item_selling_price" class="col-form-label">Harga jual</label>
                <input type="number" class="form-control" id="" name="item_selling_price" required>
            </div> -->
            <div class="modal-footer form-group">
                <button type="submit" class="btn btn-primary">Tambah Tipe</button>
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
  $('.data-inventory').DataTable({
    processing:true,
    serverSide:true,
    ajax:"{{route('inventory.inventoryJson')}}",
    columns:[
      {data:"DT_RowIndex",name:"DT_RowIndex"},
      {data:"inventory_name",name:"inventory_name"},
      {data:"inventory_stock",name:"inventory_stock"},
      {
        data:"id_inventory",
        render: function(data,type,row){
          return '<a href="/inventory/edit/'+data+'" class="btn btn-warning"><i class="fas fa-edit"></i></a> <a href="" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>';
        }
      }
    ]
  });
});
</script>