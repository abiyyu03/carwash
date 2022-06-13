@extends('layouts.master')

@section('breadcrumb')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Absensi Karyawan</h1>
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
<!-- create data -->
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-info">
        <div class="inner">
          <h4 class="font-weight-bold " id="employee_attendance">-</h4>
          <p>Karyawan Masuk</p>
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
          <p>Total Karyawan</p>
        </div>
        {{-- <div class="icon">
          <i class="ion ion-ios-box-outline"></i>
        </div> --}}
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-success">
        <div class="inner">
          <!-- <h4>53<sup style="font-size: 20px">%</sup></h4> -->
          <h4 class="font-weight-bold">{{ @$soldProduct }}</h4>
          <p>Produk terjual</p>
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
          <p>Produk</p>
        </div>
      </div>
    </div>
  </div>
  <div class="card mt-3">
    <div class="card-body">
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
            <button type="button" class="btn bg-secondary ml-2" id="reset"><i class="fa fa-reset"></i> Reset</button>
          </div>
        </div>
      </div>
    </div>
  </div>
    <div class="card mt-3">
        <div class="card-body">
          <p>Karyawan Masuk <span id="date">Hari ini</span></p>
          <div class="table-responsive">
            <table class="table data-attendance">
              <thead>
                <tr>
                  <th>#</th>
                  {{-- <th>Nama Karyawan</th> --}}
                  <th>Tanggal Absensi</th>
                  <th>Waktu Absensi</th>
                  <th>Status</th>
                  <th>Foto</th>
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
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
  <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  loadData();
 var table = $('.data-attendance').DataTable();
  function loadData(from_date = '', to_date = '') { 
  $('.data-attendance').DataTable({
    paging:true,
    processing:true,
    serverSide:true,
    ajax:{
      url:"{{route('attendance.index')}}",
      data:{from_date:from_date,to_date:to_date}
    },
    columns:[
      // {data:"DT_Row_Index",name:"DT_Row_Index", orderable:false, searchable:false},
      {data:"DT_RowIndex",name:"DT_RowIndex", orderable:false, searchable:false},
      // {data:"employee_fullname",name:"employee_fullname"},
      {data:"attendance_date",name:"attendance_date"},
      {data:"attendance_time",name:"attendance_time"},
      {data:"attendance_status",name:"attendance_status"},
      {data:"photo",name:"photo"},
      {
        data:"id_employee",
        render: function(data,type,row){
          return '<a href="/attendance/edit/'+data+'" class="btn btn-warning"><i class="fas fa-edit"></i></a> <a href="" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>';
        }
      }
      ]
    });
    }
      // {
      //   data:"image",
      //   name:"image",
      //   render: function(data,type,row){
      //     return '<img src="img/product/'+data+'">';
      //   }
      // },
      // {data:"productCategory",name:"productCategory.category_name"}
      
    $('#filter').click(function(){
      var from_date = $('#from_date').val();
      var to_date = $('#to_date').val();
      if(from_date != '' && to_date != '')
      {
        $('.data-attendance').DataTable().destroy();
        loadData(from_date,to_date);
        $('#date').text('Tanggal : '+from_date+' - '+to_date);
      } else {
        alert('Both Date is required');
      }
    });
    
    //reset date range filter
    $('#reset').click(function() {
      $('#from_date').val('');
      $('#to_date').val('');
      $('.data-attendance').DataTable().destroy();
      loadData();
      $('#date').text('Hari ini');
    });

    $('#employee_attendance').text($('.data-attendance').DataTable().page.info().recordsTotal);
});
</script>
