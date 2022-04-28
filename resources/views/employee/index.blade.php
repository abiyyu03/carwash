@extends('layouts.master')

@section('breadcrumb')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Karyawan</h1>
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
    <div class=" d-flex justify-content-end">
      <button type="button" class="btn bg-maroon" data-toggle="modal" data-target="#exampleModal">
          <i class="fas fa-plus"></i>
          Tambah Karyawan
      </button>
    </div>
    <div class="card mt-3">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table data-employee">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nama Panjang Karyawan</th>
                  <th>Nama Panggilan</th>
                  <th>NIK</th>    
                  <th>Jenis Kelamin</th>    
                  <th>Tanggal Lahir</th>
                  <th>PAS Foto</th> 
                  <th>Kontak</th>   
                  <th>Email</th>   
                  <th>Alamat</th>
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
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Karyawan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{route('employee.store')}}">
          @csrf
            <div class="form-group">
                <label for="employee_fullname" class="col-form-label">Nama lengkap</label>
                <input type="text" class="form-control" value="{{old('employee_fullname')}}" id="employee_fullname" name="employee_fullname" required>
            </div>
            <div class="form-group">
                <label for="employee_nickname" class="col-form-label">Nama Panggilan</label>
                <input type="text" class="form-control" value="{{old('employee_nickname')}}" id="employee_nickname" name="employee_nickname" required>
            </div>
            <div class="form-group">
                <label for="employee_nik" class="col-form-label">NIK</label>
                <input type="text" class="form-control" value="{{old('employee_nik')}}" id="employee_nik" name="employee_nik" required>
            </div>
            <div class="form-group">
                <label for="employee_birthdate" class="col-form-label">Tanggal Lahir</label>
                <input type="date" class="form-control" value="{{old('employee_birthdate')}}" id="employee_birthdate" name="employee_birthdate" required>
            </div>
            <div class="form-group">
                <label for="employee_gender" class="col-form-label">Gender</label>
                <select name="employee_gender" id="employee_gender" class="form-control">
                  <option>-</option>
                  <option value="Laki-Laki">Laki-Laki</option>
                  <option value="Perempuan">Perempuan</option>
                </select>
            </div>
            <div class="form-group">
                <label for="employee_contact" class="col-form-label">Kontak</label>
                <input type="text" class="form-control" value="{{old('employee_contact')}}" id="employee_contact" name="employee_contact" required>
            </div>
            <div class="form-group">
                <label for="employee_photo" class="col-form-label">Pas Foto</label>
                <input type="file" class="form-control" value="{{old('employee_photo')}}" id="employee_photo" name="employee_photo" required>
            </div>
            <div class="form-group">
                <label for="employee_email" class="col-form-label">Email</label>
                <input type="email" class="form-control" value="{{old('employee_email')}}" id="employee_email" name="employee_email" required>
            </div>
            <div class="form-group">
                <label for="employee_address" class="col-form-label">Alamat</label>
                <input type="text" class="form-control" value="{{old('employee_address')}}" id="employee_address" name="employee_address" required>
            </div>
            <div class="modal-footer form-group">
                <button type="submit" class="btn bg-maroon">Tambah Data</button>
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
  $('.data-employee').DataTable({
    processing:true,
    serverSide:true,
    ajax:"{{route('employee.employeeJson')}}",
    columns:[
      // {data:"DT_Row_Index",name:"DT_Row_Index", orderable:false, searchable:false},
      {data:"DT_RowIndex",name:"DT_RowIndex", orderable:false, searchable:false},
      {data:"employee_fullname",name:"employee_fullname"},
      {data:"employee_nickname",name:"employee_nickname"},
      {data:"employee_nik",name:"employee_nik"},
      {data:"employee_gender",name:"employee_gender"},
      {data:"employee_birthdate",name:"employee_birthdate"},
      {data:"employee_contact",name:"employee_contact"},
      {data:"employee_email",name:"employee_email"},
      {data:"employee_address",name:"employee_address"},
      {data:"employee_photo",name:"employee_photo"},
      {
        data:"id_employee",
        render: function(data,type,row){
          return '<a href="/employee/edit/'+data+'" class="btn btn-warning"><i class="fas fa-edit"></i></a> <a href="" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>';
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