@extends('layouts.master')

@section('breadcrumb')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Produk Terlaris</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item active">Analysis</li>
          <li class="breadcrumb-item active">Produk terlaris</li>
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
        <input type="date" name="from_date" class="form-control" id="from_date" >
        <input type="date" name="to_date" class="form-control ml-2" id="to_date" >
        <button type="button" class="btn bg-info ml-2" id="filter"><i class="fas fa-calendar"></i> Filter</button>
      </div>
    </div>
  </div>

  <canvas id="myChart" width="400" height="190"></canvas>
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
const labels = {{ Js::from($labels)}};
const category_data = {{ Js::from($data)}};

const data = {
  labels:labels,
  datasets: [{
    label: 'Produk terjual',
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
// const ctx = document.getElementById('myChart').getContext('2d');
// const myChart = new Chart(ctx, {
//     type: 'bar',
//     data: {
//         labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
//         datasets: [{
//             label: '# of Votes',
//             data: [12, 19, 3, 5, 2, 3],
//             backgroundColor: [
//                 'rgba(255, 99, 132, 0.2)',
//                 'rgba(54, 162, 235, 0.2)',
//                 'rgba(255, 206, 86, 0.2)',
//                 'rgba(75, 192, 192, 0.2)',
//                 'rgba(153, 102, 255, 0.2)',
//                 'rgba(255, 159, 64, 0.2)'
//             ],
//             borderColor: [
//                 'rgba(255, 99, 132, 1)',
//                 'rgba(54, 162, 235, 1)',
//                 'rgba(255, 206, 86, 1)',
//                 'rgba(75, 192, 192, 1)',
//                 'rgba(153, 102, 255, 1)',
//                 'rgba(255, 159, 64, 1)'
//             ],
//             borderWidth: 1
//         }]
//     },
//     options: {
//         scales: {
//             y: {
//                 beginAtZero: true
//             }
//         }
//     }
// });
  $(document).ready(function () {
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