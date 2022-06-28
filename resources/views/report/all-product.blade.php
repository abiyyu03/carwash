@extends('layouts.master')

@section('breadcrumb')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Laporan Per Produk</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item active">Laporan</li>
          <li class="breadcrumb-item active">Laporan Produk</li>
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
  <div id="stocks-chart"></div>
  {!!Lava::render('LineChart', 'MyStocks', 'stocks-chart')!!}
  <div class="row mt-3">
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-info">
        <div class="inner">
          <!-- <h4>53<sup style="font-size: 20px">%</sup></h4> -->
          <h4 class="font-weight-bold">{{$transactionDetail_count}}</h4>
          <p>Jumlah Produk Terjual</p>
        </div>
        {{-- <div class="icon">
          <i class="ion ion-ios-box-outline"></i>
        </div> --}}
      </div>
    </div>
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-success">
        <div class="inner">
          <h4 class="font-weight-bold" id="getTotal">Rp. {{$transactionDetail_total}}</h4>
          <p>Total Penjualan Produk</p>
        </div>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-primary">
        <div class="inner">
          <!-- <h4>53<sup style="font-size: 20px">%</sup></h4> -->
          <h4 class="font-weight-bold">{{$transactionDetailProduk_total}}</h4>
          <p>Produk terjual</p>
        </div>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-warning">
        <div class="inner">
          <!-- <h4>53<sup style="font-size: 20px">%</sup></h4> -->
          <h4 class="font-weight-bold">{{$transactionDetailServis_total}}</h4>
          <p>Kendaraan dicuci</p>
        </div>
      </div>
    </div>
  </div>
  <div class="mt-3">
    <div class="">
      <div class="form-inline justify-content-between">
        <div class="form-inline justify-content-between">
          <div class="form-group ">
            {{-- <a href="" class="btn bg-info ml-2"><i class="fas fa-file-excel"></i> Excel</a>
            <a href="/report/product/all/pdf" class="btn bg-info ml-2"><i class="fas fa-file"></i> PDF</a> --}}
          </div>
        </div>
        <div class="form-group">
        </div>
        <div class="form-group">
          {{-- <div class="input-group mr-2">
            <div class="input-group-append">
              <div class="input-group-text bg-light">
                <span class="fas fa-filter mr-1"></span>
                Kategori 
              </div>
            </div>
            <select name="" id="status" class="form-control">
              <option value="">pilih kategori</option>
              @foreach ($productCategory_data as $productCategory)   
                <option value="{{$productCategory->id_product_category}}">{{$productCategory->category_name}}</option>
              @endforeach
            </select> 
          </div> --}}
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
              <th>Nama produk</th>
              <th>Jumlah (Pcs)</th>
              <th>Total (Rp)</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
@push('addon-scripts')  
<script src="https://www.gstatic.com/charts/loader.js"></script>
<script>
  window.google.charts.load('46', {packages: ['corechart']});
  
</script>    
<script type="text/javascript">
  $(document).ready(function () {
    loadData();
    function loadData(from_date = '', to_date = '') { 
      $('.data-report').DataTable({
        processing:true,
        serverSide:true,
        ajax:{
          url:"{{route('report.allProductJson')}}",
         data:{from_date:from_date,to_date:to_date}
        },
        columns:[
          {data:"DT_RowIndex",name:"DT_RowIndex", orderable:false, searchable:false},
          {data:"product_name",name:"product_name"},
          {data:"transaction_detail_amount",name:"transaction_detail_amount"},
          {data:"transaction_detail_total",name:"transaction_detail_total"}
        ],
        dom: 'Blfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            {
              extend: 'pdfHtml5',
              messageTop:"Laporan Penjualan Produk",
              title:"Laporan Penjualan Produk Semua Waktu",
              filename:"Laporan-Harian-Jiwalu-Carwash",
              footer:true,
              header:true,
              autoWidth:true
            }
        ],
      });
    }
    function selectCallback (event, chart) {
// Useful for using chart methods such as chart.getSelection();
    console.log(chart.getSelection());
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
    $('#autofill').click(function(){
    var customer_license = $("#customer_license_plate").val();
    $.ajax({
      url:"{{route('getCustomerData')}}",
      cache:true,
      data:{customer_license_plate:customer_license},
      success:function(data){
        // console.log(data);
        var json = data;
        obj = JSON.parse(json);
        $("#customer_name").val(obj.customer_name);
        $("#customer_vehicle").val(obj.customer_vehicle);
        $("#customer_contact").val(obj.customer_contact);
        $("#id_customer").val(obj.id_customer);
      },
    });
  });
  $.getJSON('http://my.cool.site.com/api/whatever/getDataTableJson', function (dataTableJson) {
  lava.loadData('Chart1', dataTableJson, function (chart) {
    console.log(chart);
  });
});
    // $('#productCategoryFilter').change(function(){
    //   var status = $('#status').val();
    //   if(status != '')
    //   {
    //     $('.data-report').DataTable().destroy();
    //     // loadData(from_date,to_date);
    //     loadData(status);
    //   } else {
    //     $('.data-report').DataTable().destroy();
    //     loadData();
    //   }
    // });
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