@extends('layouts.master')

@section('breadcrumb')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Laporan Transaksi Harian</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Laporan</a></li>
          <li class="breadcrumb-item active">Laporan Harian</li>
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
  <div class="row">
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-info">
        <div class="inner">
          <h4 class="font-weight-bold" id="getTotal">Rp. {{$transactionTotal}}</h4>
          <p>Pendapatan Kotor</p>
        </div>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-success">
        <div class="inner">
          <!-- <h4>53<sup style="font-size: 20px">%</sup></h4> -->
          <h4 class="font-weight-bold">Rp. 0</h4>
          <p>Komisi Karyawan</p>
        </div>
        {{-- <div class="icon">
          <i class="ion ion-ios-box-outline"></i>
        </div> --}}
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-primary">
        <div class="inner">
          <!-- <h4>53<sup style="font-size: 20px">%</sup></h4> -->
          <h4 class="font-weight-bold">{{ $transactionComplete_count }}</h4>
          <p>Transaksi Complete</p>
        </div>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-warning">
        <div class="inner">
          <!-- <h4>53<sup style="font-size: 20px">%</sup></h4> -->
          <h4 class="font-weight-bold">{{ $transactionPending_count }}</h4>
          <p>Transaksi Pending</p>
        </div>
      </div>
    </div>
  </div>
  <div class="mt-3">
    <div class="">
      <div class="form-inline justify-content-between">
        <div class="form-group ">
          {{-- <a href="" class="btn bg-maroon ml-2"><i class="fas fa-table"></i> Excel</a>
          <a href="" class="btn bg-maroon ml-2"><i class="fas fa-table"></i> PDF</a> --}}
        </div>
        <div class="form-group">
          <div class="input-group">
            <div class="input-group-append">
              <div class="input-group-text bg-light">
                <span class="fas fa-calendar"></span> 
              </div>
            </div>
            <input type="date" name="from_date" class="form-control" id="from_date" >
            <input type="date" name="to_date" class="form-control ml-2" id="to_date" >
            <button type="button" class="btn bg-info ml-2" id="filter"><i class="fas fa-calendar"></i> Filter</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="card mt-3">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table data-report">
          <thead>
            <tr>
              <th>#</th>
              <th>Nama Pelanggan</th>
              <th>Plat Nomor</th>
              <th>Kasir</th>
              <th>Tanggal Transaksi</th>
              <th>Waktu Transaksi</th>
              <th>Grand Total (Rp)</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
@push('addon-scripts')      
<script type="text/javascript">
  $(document).ready(function () {
    loadData();
    function loadData(from_date = '', to_date = '') { 
      $('.data-report').DataTable({
        processing:true,
        serverSide:true,
        ajax:{
          url:"{{route('report.daily')}}",
         data:{from_date:from_date,to_date:to_date}
        },
        columns:[
          {data:"DT_RowIndex",name:"DT_RowIndex", orderable:false, searchable:false},
          {data:"customer_name",name:"customer_name.customer_name"},
          {data:"customer_license_plate",name:"customer_license_plate.customer_license_plate"},
          {data:"employee",name:"employee"},
          {data:"transaction_date",name:"transaction_date"},
          {data:"transaction_time",name:"transaction_time"},
          {data:"transaction_grandtotal",name:"transaction_grandtotal"}
        ],
        dom: 'Blfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            {
              extend: 'pdfHtml5',
              messageTop:"Laporan Transaksi",
              title:"Laporan Transaksi",
              filename:"Laporan-Harian-Jiwalu-Carwash",
              footer:true,
              header:true,
              autoWidth:true
            }
        ],
      });
    }
    $('#filter').click(function(){
      var from_date = $('#from_date').val();
      var to_date = $('#to_date').val();
      if(from_date != '' && to_date != '')
      {
        $('.data-report').DataTable().destroy();
        loadData(from_date,to_date);
      } else {
        alert('Both Date is required');
      }
    });

    // $.ajax({
    //   url:"/report/getTotal",
    //   type:"GET",
    //   dataType:"json",
    //   data:{total:total},
    //   success:function(data){
    //     if(data) {
    //       $('#getTotal').text(data.success);
    //       // $("#ajaxform")[0].reset();
    //     }
    //   },
    // });
    // $('#from_date').daterangepicker({
    //   opens: 'left'
    // }, function(start, end, label) {
    //   var from_date = start.format('YYYY-MM-DD'); 
    //   var to_date = end.format('YYYY-MM-DD');
    //   if(from_date != '' && to_date != '')
    //   {
    //     $('.data-report').DataTable().destroy();
    //     loadData(from_date,to_date);
    //   } else {
    //     alert('Both Date is required');
    //   }
    // });

});
</script>
@endpush