@extends('layouts.master')

@section('breadcrumb')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Waktu Teramai</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item active">Laporan</li>
          <li class="breadcrumb-item active">Laporan Kategori</li>
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
  <div class="d-flex justify-content-end">
    <div class="form-group">
      <div class="input-group">
        <div class="input-group-append">
          <div class="input-group-text bg-light">
            <span class="fas fa-calendar"></span> 
          </div>
        </div>
        <select name="based_filter" id="based_filter" class="form-control">
          <option value="">-</option>
          <option value="hourly">Jam</option>
          <option value="daily">Hari</option>
          <option value="date">Tanggal</option>
          <option value="month">Bulan</option>
        </select>
        <input type="text" name="reportrange" class="form-control" id="reportrange">
        <button type="button" class="btn bg-info ml-2" id="filter"><i class="fas fa-calendar"></i> Filter</button>
      </div>
    </div>
  </div>
  <canvas id="myChart" width="400" height="200"></canvas>
  <div class="row">
  </div>
  <div class="mt-3">
    <div class="">
      <div class="form-inline justify-content-between">
        <div class="form-group ">
          {{-- <a href="" class="btn bg-maroon ml-2"><i class="fas fa-table"></i> Excel</a>
          <a href="" class="btn bg-maroon ml-2"><i class="fas fa-table"></i> PDF</a> --}}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@push('addon-scripts')      
<script>
  //chart
  const labels = {{ Js::from($labels)}};
  const category_data = {{ Js::from($data)}};
  
  const data = {
    labels:labels,
    datasets: [{
      label: 'Kategori Produk terjual',
      backgroundColor:'rgb(255,99,132)',
      borderColor:'rgb(255,99,132)',
      data:category_data,
    }]
  };
  
  const config = {
    type:'line',
    data:data,
    options:{}
  };
  const myChart = new Chart(
  document.getElementById('myChart'),
  config
  );
  
  // myChart.destroy();
  //range date filter
  $(document).ready(function () {
    var start = moment().subtract(29, 'days');
    var end = moment();

    function cb(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }

    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);
    
    cb(start, end);
    
    $('#filter').click(function(){
      var from_date = start.format('Y-MM-D');
      var to_date = end.format('Y-MM-D');
      // if(from_date != '' && to_date != '')
      let based_filter = $('#based_filter').val();
      if(based_filter != '' || from_date != '' && to_date != ''){
      $.ajax({
        type:'GET',
        // data:{from_date:from_date, to_date:to_date},
        data:{
          from_date:from_date, 
          to_date:to_date,
          based_filter:based_filter
        },
        success:function (response) {
          // console.log(response);
          // var charts = Object.keys(response).length;
          if(myChart.data.labels != ''){
            for(const key in myChart.data){
              myChart.data.labels.shift();
              myChart.data.datasets[0].data.shift();
            }
          } else {
            var i = 0;
            for(const key in response){
              myChart.data.labels.push(key);
              myChart.data.datasets[0].data.push(Object.values(response)[i++]);
              myChart.update();
            }
          }
            // }
        }
        });
      }
    });

});
</script>
@endpush