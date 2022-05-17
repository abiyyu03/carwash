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
    <div class="card mt-3">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table data-attendance">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nama Karyawan</th>
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
  $('.data-employee').DataTable({
    processing:true,
    serverSide:true,
    ajax:"{{route('attendance.attendanceJson')}}",
    columns:[
      // {data:"DT_Row_Index",name:"DT_Row_Index", orderable:false, searchable:false},
      {data:"DT_RowIndex",name:"DT_RowIndex", orderable:false, searchable:false},
      {data:"employee_fullname",name:"employee_fullname"},
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
      // {
      //   data:"image",
      //   name:"image",
      //   render: function(data,type,row){
      //     return '<img src="img/product/'+data+'">';
      //   }
      // },
      // {data:"productCategory",name:"productCategory.category_name"}
    ]
  });
});
</script>
