@extends('layouts.master')

@section('breadcrumb')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Pelanggan</h1>
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
<div class="container-fluid">
  <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table data-customer">
            <thead>
              <tr>
                <th>#</th>
                <th>Nama Pelanggan</th>
                <th>Kontak Pelanggan</th>
                <th>Plat Nomor</th>
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
  $('.data-customer').DataTable({
    processing:true,
    serverSide:true,
    ajax:"{{route('customer.customerJson')}}",
    columns:[
      {data:"DT_RowIndex",name:"DT_RowIndex"},
      {data:"customer_name",name:"customer_name"},
      {data:"customer_contact",name:"customer_contact"},
      {data:"customer_license_plate",name:"customer_license_plate"},
      {
        data:"id_customer",
        render: function(data,type,row){
          return '<a href="/customer/edit/'+data+'" class="btn btn-warning"><i class="fas fa-edit"></i></a> <a href="" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>';
        }
      }
    ]
  });
});
</script>