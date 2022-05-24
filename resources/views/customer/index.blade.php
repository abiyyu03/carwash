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
                <th>Mobil Pelanggan</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach($customer_data as $customer)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $customer->customer_name }}</td>
                  <td>{{ $customer->customer_contact }}</td>
                  <td>{{ $customer->customer_license_plate }}</td>
                  <td>{{ $customer->customer_vehicle }}</td>
                  <td><!-- <a href="#" id="detailButton" class="btn btn-primary"><i class="fas fa-info-circle"></i> Detail</a> -->
                      <a href="#" id="editButton" data-toggle="modal" data-target="#editModal" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a> 
                      <a href="/customer/delete/{{ $customer->id_customer }}" id="deleteButton" class="btn btn-danger deleteButton"><i class="fas fa-trash-alt"></i> Delete</a> </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
  </div>
</div>
<!-- edit data -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Customer</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="" method="POST" id="editForm">
            @csrf
            {{method_field('PUT')}}          
            <div class="form-group">
              <label for="customer_name">Nama Customer</label>
              <input type="text" name="customer_name" id="customer_name" class="form-control">
            </div>
            <div class="form-group">
              <label for="customer_contact">Kontak Customer</label>
              <input type="text" name="customer_contact" id="customer_contact" class="form-control">
            </div>
            <div class="form-group">
              <label for="customer_license_plate">Plat Nomor Kendaraan</label>
              <input type="text" name="customer_license_plate" id="customer_license_plate" class="form-control">
            </div>
            <div class="form-group">
              <label for="customer_vehicle">Merk Kendaraan</label>
              <input type="text" name="customer_vehicle" id="customer_vehicle" class="form-control">
            </div>
            <div class="modal-footer form-group">
              <button type="submit" class="btn btn-info">Edit Customer</button>
            </div>
          </form>
        </div>
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
  // $('.data-customer').DataTable({
  //   processing:true,
  //   serverSide:true,
  //   ajax:"{{route('customer.customerJson')}}",
  //   columns:[
  //     {data:"DT_RowIndex",name:"DT_RowIndex"},
  //     {data:"customer_name",name:"customer_name"},
  //     {data:"customer_contact",name:"customer_contact"},
  //     {data:"customer_license_plate",name:"customer_license_plate"},
  //     {
  //       data:"id_customer",
  //       render: function(data,type,row){
  //         return '<a href="/customer/edit/'+data+'" class="btn btn-warning"><i class="fas fa-edit"></i></a> <a href="/customer/delete/'+data+'" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>';
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
      showCancelButton: true,
      confirmButtonText: 'Yakin !'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = url;
        }
    });
  });

  var table = $('.data-customer').DataTable();
  // $('#editButton').on("click",function(){
  table.on("click",'#editButton',function(){
    $tr = $(this).closest('tr');
    if($($tr).hasClass('child')){
      $tr = $tr.prev('.parent');
    }

    var data = table.row($tr).data();
    // console.log(data);

    $('#customer_name').val(data[1]);
    $('#customer_contact').val(data[2]);
    $('#customer_license_plate').val(data[3]);
    $('#customer_vehicle').val(data[4]);
    $('#editForm').attr('action','customer/update/'+data[0]);
    $('#editModal').modal('show');

  });
});
</script>