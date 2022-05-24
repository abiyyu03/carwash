@extends('layouts.master')

@section('breadcrumb')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Kelola Akun</h1>
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
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  <i class="fas fa-plus"></i>
  Tambah Data
</button> -->
<div class="container-fluid">
  <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table data-user">
            <thead>
              <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <!-- <th>Aksi</th> -->
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
        <h5 class="modal-title" id="exampleModalLabel">Tambah Paket Steam</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Nama Paket Steam</label>
            <input type="text" class="form-control" id="service_packet_name" name="service_packet_name" required>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Harga paket steam</label>
            <input type="number" class="form-control" id="service_packet_price" name="service_packet_price" required>
          </div>
          <div class="modal-footer form-group">
            <button type="submit" class="btn btn-primary">Tambah Paket</button>
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
  $('.data-user').DataTable({
    processing:true,
    serverSide:true,
    ajax:"{{route('user.userJson')}}",
    columns:[
      {data:"DT_RowIndex",name:"DT_RowIndex"},
      {data:"name",name:"name"},
      {data:"email",name:"email"},
      {data:"role.role_name",name:"role.role_name"},
      // {
      //   data:"id_customer",
      //   render: function(data,type,row){
      //     return '<a href="/customer/edit/'+data+'" class="btn btn-warning"><i class="fas fa-edit"></i></a> <a href="" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>';
      //   }
      // }
    ]
  });
});
</script>