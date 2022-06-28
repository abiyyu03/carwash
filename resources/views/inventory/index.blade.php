@extends('layouts.master')
@section('breadcrumb')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Daftar Inventori</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item active">Inventory</li>
          <li class="breadcrumb-item active">Inventory</li>
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
      <button type="button" class="btn bg-info" data-toggle="modal" data-target="#exampleModal">
          <i class="fas fa-plus"></i>
          Tambah Inventori
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
                  <th>Kode Barang</th>
                  <th>Jumlah Barang</th>
                  <th>Harga Modal</th>
                  <th>Penggunaan</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach($inventory_data as $inventory)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $inventory->inventory_name }}</td>
                  <td>{{ $inventory->inventory_code }}</td>
                  <td>{{ $inventory->inventory_unit }}</td>
                  <td>{{ $inventory->inventory_capital_price }}</td>
                  <td>{{ $inventory->inventory_usage }}</td>
                  <td><a href="#" id="editButton" data-toggle="modal" data-target="#editModal" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a> 
                      <a href="/inventory/delete/{{ $inventory->id_inventory }}" id="deleteButton" class="btn btn-danger deleteButton"><i class="fas fa-trash-alt"></i> Hapus</a></td>
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
        <h5 class="modal-title" id="exampleModalLabel">Tambah Inventori</h5>
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
            <div class="form-group">
                <label for="inventory_code" class="col-form-label">Kode Barang</label>
                <input type="text" class="form-control" id="" name="inventory_code" required>
            </div>
            {{-- <div class="form-group">
                <label for="inventory_unit" class="col-form-label">Jumlah Barang</label>
                <input type="text" class="form-control" id="" name="inventory_unit" required>
            </div> --}}
            <div class="form-group">
                <label for="inventory_usable" class="col-form-label">Penggunaan (khusus bahan steam)</label>
                <input type="number" class="form-control" id="" name="inventory_usable">
            </div>
            <div class="form-group">
                <label for="inventory_usage" class="col-form-label">Takaran Barang</label>
                <input type="number" class="form-control" id="" readonly placeholder="Diisi saat input barang">
            </div>
            <div class="form-group">
                <label for="inventory_capital_price" class="col-form-label">Harga modal</label>
                <input type="number" class="form-control" id="" readonly placeholder="Diisi saat input barang">
            </div>
            <div class="modal-footer form-group">
                <button type="submit" class="btn btn-info">Tambah Inventori</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- edit data -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Inventori</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="" id="editForm">
          @csrf
          {{method_field('PUT')}}
            <div class="form-group">
                <label for="Item_name" class="col-form-label">Nama Barang</label>
                <input type="text" class="form-control" id="edit_inventory_name" name="inventory_name" required>
            </div>
            <div class="form-group">
                <label for="inventory_code" class="col-form-label">Kode Barang</label>
                <input type="text" class="form-control" id="edit_inventory_code" name="inventory_code" required>
            </div>
            <div class="form-group">
                <label for="inventory_unit" class="col-form-label">Jumlah Barang</label>
                <input type="text" class="form-control" id="edit_inventory_unit" name="inventory_unit" required>
            </div>
            <div class="form-group">
                <label for="inventory_usable" class="col-form-label">Penggunaan (khusus bahan steam)</label>
                <input type="number" class="form-control" id="edit_inventory_usable" name="inventory_usable" required>
            </div>
            <!-- <div class="form-group">
                <label for="inventory_usage" class="col-form-label">Takaran Barang</label>
                <input type="number" class="form-control" id="" name="inventory_usage" required>
            </div> -->
            <div class="form-group">
                <label for="inventory_capital_price" class="col-form-label">Harga modal</label>
                <input type="number" class="form-control" id="edit_inventory_capital_price" name="inventory_capital_price" required>
            </div>
            <div class="modal-footer form-group">
                <button type="submit" class="btn btn-info">Edit Inventori</button>
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
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  // $('.data-inventory').DataTable({
  //   processing:true,
  //   serverSide:true,
  //   ajax:"{{route('inventory.inventoryJson')}}",
  //   columns:[
  //     {data:"DT_RowIndex",name:"DT_RowIndex"},
  //     {data:"inventory_name",name:"inventory_name"},
  //     {data:"inventory_code",name:"inventory_code"},
  //     {data:"inventory_unit",name:"inventory_unit"},
  //     {data:"inventory_usage",name:"inventory_usage"},
  //     {
  //       data:"id_inventory",
  //       render: function(data,type,row){
  //         return '<a href="/inventory/edit/'+data+'" class="btn btn-warning"><i class="fas fa-edit"></i></a> <a href="" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>';
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

  var table = $('.data-inventory').DataTable();
  // $('#editButton').on("click",function(){
  table.on("click",'#editButton',function(){
    $tr = $(this).closest('tr');
    if($($tr).hasClass('child')){
      $tr = $tr.prev('.parent');
    }

    var data = table.row($tr).data();
    // console.log(data);

    $('#edit_inventory_name').val(data[1]);
    $('#edit_inventory_code').val(data[2]);
    $('#edit_inventory_unit').val(data[3]);
    $('#edit_inventory_capital_price').val(data[4]);
    $('#edit_inventory_usable').val(data[5]);
    // $('#edit_product_category_id').val(data[6]);
    $('#editForm').attr('action','inventory/update/'+data[0]);
    $('#editModal').modal('show');

  });
  
});
</script>