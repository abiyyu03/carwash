@extends('layouts.master')
@section('breadcrumb')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Daftar Transaksi</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Transaksi</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
@endsection
@section('content')
<div class="container-fluid">
@if($errors->any())
  <div class="alert-danger alert">
    <ul>
      @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif
<div class=" d-flex justify-content-end">
  <a class="btn bg-info" href="#" data-toggle="modal" data-target="#exampleModal">
    <i class="fas fa-exchange-alt"></i>
    Buat Transaksi
  </a>
</div>
<div class="card mt-3">
  <div class="card-body">
    <div class="row d-flex justify-content-between">
      <div class="col-md-4">
        <div class="input-group">
          <div class="input-group-append">
            <div class="input-group-text bg-light">
              <span class="fas fa-calendar"></span> 
            </div>
          </div>
          <input type="text" name="from_date" class="form-control" id="from_date" readonly>
        </div>
      </div>
      <div class="col-md-4">
        <div class="input-group">
          <div class="input-group-append">
            <div class="input-group-text bg-light">
              <span class="fas fa-filter"></span> 
              Status Transaksi
            </div>
          </div>
          <select name="" id="" class="form-control">
            <option value="">Semua</option>
            <option value="pending">Pending</option>
            <option value="complete">Complete</option>
          </select>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="card mt-3">
    <div class="card-body">
        Halaman Transaksi
        <div class="table-responsive">
        <table class="table data-transaction table-striped table-bordered" style="width:100%">
          <thead class="table-dark">
            <tr>
              <th>#</th>
              <th>Nama Customer</th>
              <th>Tanggal Transaksi</th>
              <th>Jam Transaksi</th>
              <th>Status Transaksi</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($transaction_data as $transaction)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $transaction->customer->customer_name }}</td>
              <td>{{ \Carbon\Carbon::parse($transaction->transaction_timestamp)->isoFormat('dddd, D MMMM Y') }}</td>
              <td>{{ \Carbon\Carbon::parse($transaction->transaction_timestamp)->isoFormat('HH:mm') }}</td> 
              <td>{{ $transaction->transaction_status }}</td>
              <td><a href="/transaction/{{ $transaction->id_transaction}}/select-product" class="btn btn-primary"><i class="fas fa-eye"></i> Lihat</a> 
                  <a href="/transaction/delete/{{ $transaction->id_transaction}}" class="btn btn-danger" id="deleteButton"><i class="fas fa-trash-alt"></i> Hapus</a></td>
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
              <div class="form-group">
                  <label for="customer_vehicle">Merk Kendaraan</label>
                  <input type="text" name="customer_vehicle" class="form-control">
              </div>
            </div>
            <div class="modal-footer form-group">
              <a href="#" id="clickTambah" onclick="clickTambah()" class="btn bg-secondary">Tambah Data Pelanggan</a>
              <a href="#" id="clickExisting" onclick="clickExisting()" class="btn bg-secondary" style="display:none">Ambil Data sebelumnya</a>
              <button type="submit" class="btn bg-info">
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
                <select name="id_customer" class="form-control" required>
                    <!-- <option>-</option> -->
                    <option value="">-</option>
                    @foreach($customer_data as $customer)
                      <option value="{{ $customer->id_customer }}">{{ $customer->customer_name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn bg-info form-control">
              <i class="fas fa-check"></i>
              Lanjutkan
            </button>
            <a href="#" id="clickTambah" onclick="clickTambah()" class="justify-content-center d-flex mt-2 btn btn-secondary">Tambah Data Pelanggan</a> 
            <a href="#" id="clickExisting" onclick="clickExisting()" class="btn btn-secondary" style="display:none">Ambil Data sebelumnya</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@push('addon-scripts')
<script>
$(document).ready(function(){
    $('.data-transaction').DataTable();
    //   processing:true,
    //   serverSide:true,
    //   ajax:"{{route('transaction.transactionJson')}}",
    //   columns:[
    //     // {data:"DT_Row_Index",name:"DT_Row_Index", orderable:false, searchable:false},
    //     {data:"DT_RowIndex",name:"DT_RowIndex", orderable:false, searchable:false},
    //     {data:"customer",name:"customer.customer_name"},
    //     {data:"transaction_timestamp",name:"transaction_timestamp"},
    //     // {data:"transaction_status",name:"transaction_status"},
    //     {
    //       data:"transaction_status",
    //       name:"transaction_status",
    //       render: function(data,type,row,name){
    //         return '<span class="warning rounded p-1">'+data+'</span>'
    //       }
    //     },
    //     {
    //       data:"id_transaction",
    //       render: function(data,type,row){
    //         return '<a href="/transaction/'+data+'/select-product" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a> <a href="/transaction/delete/'+data+'" class="btn btn-danger deleteButton"><i class="fas fa-trash-alt"></i> Hapus</a>';
    //       }
    //     }
    //   ]
    // });
    // loadData();
    // function loadData(from_date = '', to_date = '') { 
    //   $('.data-report').DataTable({
    //     processing:true,
    //     serverSide:true,
    //     ajax:{
    //       url:"{{route('report.all')}}",
    //      data:{from_date:from_date,to_date:to_date}
    //     },
    //     columns:[
    //       {data:"DT_RowIndex",name:"DT_RowIndex", orderable:false, searchable:false},
    //       {data:"product",name:"product.product_name"},
    //       {data:"transaction_detail_amount",name:"transaction_detail_amount"},
    //       {data:"transaction_detail_total",name:"transaction_detail_total"}
    //     ]
    //   });
    // }
  });
  $('#from_date').daterangepicker({
    opens: 'left'
  }, function(start, end, label) {
    var from_date = start.format('YYYY-MM-DD'); 
    var to_date = end.format('YYYY-MM-DD');
    if(from_date != '' && to_date != '')
    {
      $('.data-report').DataTable().destroy();
      loadData(from_date,to_date);
    } else {
      alert('Both Date is required');
    }
  });
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
</script>
@endpush
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

