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
      <button type="button" class="btn bg-info" data-toggle="modal" data-target="#exampleModal">
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
                  <th>NIP</th>
                  <th>Nama Panjang Karyawan</th>
                  <!-- <th>Nama Panggilan</th> -->
                  <th>NIK</th>
                  <th>Jenis Kelamin</th>
                  <th>Tanggal Lahir</th>
                  <th>Kontak</th>
                  <th class="d-none">Email</th>
                  <th class="d-none">Alamat</th> 
                  <th class="d-none">PAS Foto</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach($employee_data as $employee)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $employee->id_employee }}</td>
                    <td>{{ $employee->employee_fullname }}</td>
                    <td>{{ $employee->employee_nik }}</td>
                    <td>{{ $employee->employee_gender }}</td>
                    <td>{{ $employee->employee_birthdate }}</td>
                    <td>{{ $employee->employee_contact }}</td>
                    <td class="d-none">{{ $employee->employee_email }}</td>
                    <td class="d-none">{{ $employee->employee_address }}</td>
                    <td class="d-none">{{ $employee->employee_photo }}</td>
                    <td><a href="#" id="detailButton" data-toggle="modal" data-target="#detailModal" class="btn btn-primary"><i class="fas fa-info-circle"></i> Detail</a> 
                        <a href="#" id="editButton" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a> 
                        <a href="/employee/delete/{{ $employee->id_employee }}" class="btn btn-danger deleteButton"><i class="fas fa-trash-alt"></i> Delete</a></td>
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
        <h5 class="modal-title" id="exampleModalLabel">Daftarkan Karyawan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{route('employee.store')}}" enctype="multipart/form-data">
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
                <input type="file" accept="image/jpg,image/jpeg,image/png" class="form-control" value="{{old('employee_photo')}}" id="employee_photo" name="employee_photo" required>
            </div>
            <div class="form-group">
                <label for="employee_address" class="col-form-label">Alamat</label>
                <input type="text" class="form-control" value="{{old('employee_address')}}" id="employee_address" name="employee_address" required>
            </div>
            <div class="form-group">
                <label for="employee_email" class="col-form-label">Email</label>
                <input type="email" class="form-control" value="{{old('employee_email')}}" id="employee_email" name="employee_email" required>
            </div>
            <div class="form-group">
                <label for="password" class="col-form-label">Password</label>
                <input type="password" class="form-control" value="{{old('password')}}" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="role_id" class="col-form-label">Password</label>
                <!-- <input type="role_id" class="form-control" value="{{old('role_id')}}" id="role_id" name="role_id" required> -->
                <select class="form-control" name="role_id">
                  <option>-</option>
                  @foreach($role_data as $role)
                    <option value="{{$role->id_role}}">{{$role->role_name}}</option>
                  @endforeach
                </select>
            </div>
            <div class="modal-footer form-group">
                <button type="submit" class="btn bg-info">Tambah Data</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Edit Data -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Daftarkan Karyawan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="" enctype="multipart/form-data" id="editForm">
          @csrf
          {{ method_field('PUT') }}
            <div class="form-group">
                <label for="employee_fullname" class="col-form-label">Nama lengkap</label>
                <input type="text" class="form-control" value="{{old('employee_fullname')}}" id="edit_employee_fullname" name="employee_fullname" required>
            </div>
            <div class="form-group">
                <label for="employee_nickname" class="col-form-label">Nama Panggilan</label>
                <input type="text" class="form-control" value="{{old('employee_nickname')}}" id="edit_employee_nickname" name="employee_nickname" required>
            </div>
            <div class="form-group">
                <label for="employee_nik" class="col-form-label">NIK</label>
                <input type="text" class="form-control" value="{{old('employee_nik')}}" id="edit_employee_nik" name="employee_nik" required>
            </div>
            <div class="form-group">
                <label for="employee_birthdate" class="col-form-label">Tanggal Lahir</label>
                <input type="date" class="form-control" value="{{old('employee_birthdate')}}" id="edit_employee_birthdate" name="employee_birthdate" required>
            </div>
            <div class="form-group">
                <label for="employee_gender" class="col-form-label">Gender</label>
                <select name="employee_gender" id="edit_employee_gender" class="form-control">
                  <option>-</option>
                  <option value="Laki-Laki">Laki-Laki</option>
                  <option value="Perempuan">Perempuan</option>
                </select>
            </div>
            <div class="form-group">
                <label for="employee_contact" class="col-form-label">Kontak</label>
                <input type="text" class="form-control" value="{{old('employee_contact')}}" id="edit_employee_contact" name="employee_contact" required>
            </div>
            <div class="form-group">
                <label for="employee_photo" class="col-form-label">Pas Foto</label>
                <input type="file" accept="image/jpg,image/jpeg,image/png" class="form-control" value="{{old('employee_photo')}}" id="edit_employee_photo" name="employee_photo" required>
            </div>
            <div class="form-group">
                <label for="employee_address" class="col-form-label">Alamat</label>
                <input type="text" class="form-control" value="{{old('employee_address')}}" id="edit_employee_address" name="employee_address" required>
            </div>
            <div class="form-group">
                <label for="employee_email" class="col-form-label">Email</label>
                <input type="email" class="form-control" value="{{old('employee_email')}}" id="edit_employee_email" name="employee_email" required>
            </div>
            <!-- <div class="form-group">
                <label for="password" class="col-form-label">Password</label>
                <input type="password" class="form-control" value="{{old('password')}}" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="role_id" class="col-form-label">Password</label>
                <select class="form-control" name="role_id">
                  <option>-</option>
                  @foreach($role_data as $role)
                    <option value="{{$role->id_role}}">{{$role->role_name}}</option>
                  @endforeach
                </select>
            </div> -->
            <div class="modal-footer form-group">
                <button type="submit" class="btn bg-info">Edit Data</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Data Karyawan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">
          <img src="" class="img rounded mx-auto d-block" id="detail_employee_photo" alt="" style="border-radius:50%">
          <table class="table table-responsive mt-3 mx-auto">
            <tr>
              <td>Nama Lengkap</td>
              <td> : </td>
              <td><span id="detail_employee_fullname"></span></td>
            </tr>
            <tr>
              <td>NIP</td>
              <td> : </td>
              <td><span id="detail_id_employee"></span></td>
            </tr>
            <tr>
              <td>NIK</td>
              <td> : </td>
              <td><span id="detail_employee_nik"></span></td>
            </tr>
            <tr>
              <td>Gender</td>
              <td> : </td>
              <td><span id="detail_employee_gender"></span></td>
            </tr>
            <tr>
              <td>Tanggal Lahir</td>
              <td> : </td>
              <td><span id="detail_employee_birthdate"></span></td>
            </tr>
            <tr>
              <td>Kontak</td>
              <td> : </td>
              <td><span id="detail_employee_contact"></span></td>
            </tr>
            <tr>
              <td>Alamat</td>
              <td> : </td>
              <td><span id="detail_employee_address"></span></td>
            </tr>
            <tr>
              <td>Email</td>
              <td> : </td>
              <td><span id="detail_employee_email"></span></td>
            </tr>
          </table>
        </div>
      </div>
      <div class="modal-footer form-group">
        <button type="button" class=" btn btn-secondary" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i> Close</button>
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
  $('.data-employee').DataTable();
  //   processing:true,
  //   serverSide:true,
  //   ajax:"{{route('employee.employeeJson')}}",
  //   columns:[
  //     // {data:"DT_Row_Index",name:"DT_Row_Index", orderable:false, searchable:false},
  //     {data:"DT_RowIndex",name:"DT_RowIndex", orderable:false, searchable:false},
  //     {data:"id_employee",name:"id_employee"},
  //     {data:"employee_fullname",name:"employee_fullname"},
  //     {data:"employee_nickname",name:"employee_nickname"},
  //     {data:"employee_nik",name:"employee_nik"},
  //     {data:"employee_gender",name:"employee_gender"},
  //     // {data:"employee_birthdate",name:"employee_birthdate"},
  //     // {data:"employee_photo",name:"employee_photo"},
  //     // {data:"employee_contact",name:"employee_contact"},
  //     // {data:"employee_email",name:"employee_email"},
  //     // {data:"employee_address",name:"employee_address"},
  //     {
  //       data:"id_employee",
  //       render: function(data,type,row){
  //         return '<a href="/employee/detail/'+data+'" class="btn btn-primary"><i class="fas fa-info-circle"></i> Detail</a> <a href="/employee/edit/'+data+'" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a> <a href="/employee/delete/'+data+'" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Delete</a>';
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

  var table = $('.data-employee').DataTable();
  // $('#editButton').on("click",function(){
  table.on("click",'#editButton',function(){
    $tr = $(this).closest('tr');
    if($($tr).hasClass('child')){
      $tr = $tr.prev('.parent');
    }

    var data = table.row($tr).data();

    $('#edit_employee_fullname').val(data[2]);
    $('#edit_id_employee').val(data[1]);
    $('#edit_employee_nik').val(data[3]);
    $('#edit_employee_gender').val(data[4]);
    $('#edit_employee_birthdate').val(data[5]);
    $('#edit_employee_contact').val(data[6]);
    $('#edit_employee_email').val(data[7]);
    $('#edit_employee_address').val(data[8]);
    // $('#edit_employee_photo').attr('src','img/employee/'+data[9]);
    $('#editForm').attr('action','employee/update/'+data[1]);
    $('#editModal').modal('show');

  });

  table.on("click",'#detailButton',function(){
    $tr = $(this).closest('tr');
    if($($tr).hasClass('child')){
      $tr = $tr.prev('.parent');
    }

    var data = table.row($tr).data();
    $('#detail_employee_fullname').text(data[2]);
    $('#detail_id_employee').text(data[1]);
    $('#detail_employee_nik').text(data[3]);
    $('#detail_employee_gender').text(data[4]);
    $('#detail_employee_birthdate').text(data[5]);
    $('#detail_employee_contact').text(data[6]);
    $('#detail_employee_email').text(data[7]);
    $('#detail_employee_address').text(data[8]);
    $('#detail_employee_photo').attr('src','img/employee/'+data[9]);
    $('#detailModal').modal('show');

  });
  
});
</script>
