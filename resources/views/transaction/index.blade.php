@extends('layouts.master')
@section('breadcrumb')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Dashboard</h1>
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
    <a class="btn bg-maroon" href="/transaction/checkout" data-toggle="modal" data-target="#exampleModal">
        <i class="fas fa-exchange-alt"></i>
        Tambah Transaksi
    </a>
</div>
<div class="card mt-3">
    <div class="card-body">
        Halaman Transaksi
        <div class="table-responsive">
        <table class="table data-transaction">
          <thead>
            <tr>
              <th>#</th>
              <th>Nama Customer</th>
              <th>Waktu Transaksi</th>
              <th>Status Transaksi</th>
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
          <h5 class="modal-title" id="exampleModalLabel">Buat Transaksi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{route('transaction.create')}}" method="POST" enctype="multipart/form-data" style="display:none" id="tambah-customer">
            @csrf
            <div>
              <div class="form-group">
                  <label for="customer_name">Nama Customer</label>
                  <input type="text" name="customer_name" class="form-control">
              </div>
              <div class="form-group">
                  <label for="customer_contact">Kontak Customer</label>
                  <input type="text" name="customer_contact" class="form-control">
              </div>
              <div class="form-group">
                  <label for="customer_license_plate">Plat Nomor Kendaraan</label>
                  <input type="text" name="customer_license_plate" class="form-control">
              </div>
              <!-- <div class="form-group">
                  <label for="vehicle_type_id">Tipe Kendaraan</label>
                  <select name="vehicle_type_id" class="form-control">
                      <option>-</option>
                  </select>
              </div> -->
            </div>
            <div class="modal-footer form-group">
              <a href="#" id="clickTambah" onclick="clickTambah()" class="text-maroon">Tambah Data Pelanggan</a>
              <a href="#" id="clickExisting" onclick="clickExisting()" class="text-maroon" style="display:none">Ambil Data sebelumnya</a>
              <button type="submit" class="btn bg-maroon">
                <i class="fas fa-check"></i>
                Lanjutkan
              </button>
            </div>
          </form>
          
          <form action="{{route('transaction.useExisting')}}" method="POST" enctype="multipart/form-data" id="licence_plate">
            @csrf
            <div class="form-group">
                <label for="id_customer">Cek Plat Kendaraan</label>
                <!-- better use select with search bar -->
                <select name="id_customer" class="form-control" >
                    <!-- <option>-</option> -->
                    <option>-</option>
                    @foreach($customer_data as $customer)
                      <option value="{{ $customer->id_customer }}">{{ $customer->customer_license_plate }}</option>
                    @endforeach
                </select>
            </div>
            <a href="#" id="clickTambah" onclick="clickTambah()" class="text-maroon">Tambah Data Pelanggan</a>
            <a href="#" id="clickExisting" onclick="clickExisting()" class="text-maroon" style="display:none">Ambil Data sebelumnya</a>
            <button type="submit" class="btn bg-maroon">
              <i class="fas fa-check"></i>
              Lanjutkan
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  $('.data-transaction').DataTable({
    processing:true,
    serverSide:true,
    ajax:"{{route('transaction.transactionJson')}}",
    columns:[
      // {data:"DT_Row_Index",name:"DT_Row_Index", orderable:false, searchable:false},
      {data:"DT_RowIndex",name:"DT_RowIndex", orderable:false, searchable:false},
      {data:"customer",name:"customer.customer_name"},
      {data:"transaction_timestamp",name:"transaction_timestamp"},
      // {data:"transaction_status",name:"transaction_status"},
      {
        data:"transaction_status",
        name:"transaction_status",
        render: function(data,type,row,name){
          return '<span class="bg-warning rounded p-1">'+data+'</span>'
        }
      },
      {
        data:"id_transaction",
        render: function(data,type,row){
          return '<a href="/transaction/'+data+'/selectProduct" class="btn btn-warning"><i class="fas fa-edit"></i></a> <a href="" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>';
        }
      }
    ]
  });
});
</script>
<script>
    $("#licence_plate").select2();
    let tambah = document.getElementById('tambah-data');

    function clickTambah()
    {
      $("#licence_plate").hide();
      $("#tambah-customer").show();
      $("#clickTambah").hide();
      $("#clickExisting").show();
    }
    function clickExisting()
    {
      $("#licence_plate").show();
      $("#tambah-customer").hide();
      $("#clickTambah").show();
      $("#clickExisting").hide();
    }
</script>