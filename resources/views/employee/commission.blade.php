@extends('layouts.master')

@section('breadcrumb')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Komisi </h1>
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
    <div class="card">
      <div class="card-body">
        <div class="form-control">

        </div>
      </div>
    </div>
    <div class="card mt-3">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table data-commission">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nama Panjang Karyawan</th>
                  <th>NIP</th>
                  <th>Tanggal</th>
                  <th>Total Komisi</th>
                  <!-- <th>Aksi</th> -->
                </tr>
              </thead>
              <tbody>
                @foreach($arr as $employee)
                @if($employee['date'] == date('Y-m-d'))
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $employee['name'] }}</td>
                  <td>{{ $employee['nip'] }}</td>
                  <td>{{ $employee['date'] }}</td>
                  <td>{{ $employee['commission'] }}</td>
                </tr>
                @endif
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
    </div>
</div>
@endsection
@push('addon-scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
  <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  $('.data-commission').DataTable({
    dom: 'Bfrtip',
    buttons:[
      'excel',
      {
        title:'Data Komisi karyawan',
        extend: 'pdf',
        customize: function (doc) {
        doc.content[1].table.widths = 
            Array(doc.content[1].table.body[0].length + 1).join('*').split('');
      }
}
    ]
  });
  // $('.data-commission').DataTable({
  //   processing:true,
  //   serverSide:true,
  //   ajax:"{{route('commission.commissionJson')}}",
  //   columns:[
  //     // {data:"DT_Row_Index",name:"DT_Row_Index", orderable:false, searchable:false},
  //     {data:"DT_RowIndex",name:"DT_RowIndex", orderable:false, searchable:false},
  //     {data:"employee_fullname",name:"employee_fullname.employee_fullname"},
  //     {data:"employee",name:"employee.id_employee"},
  //     {data:"commission",name:"commission"}
  //     // {
  //     //   data:"id_employee",
  //     //   render: function(data,type,row){
  //     //     return '<a href="/employee/edit/'+data+'" class="btn btn-warning"><i class="fas fa-edit"></i></a> <a href="" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>';
  //     //   }
  //     // }
  //     // {
  //     //   data:"image",
  //     //   name:"image",
  //     //   render: function(data,type,row){
  //     //     return '<img src="img/product/'+data+'">';
  //     //   }
  //     // },
  //     // {data:"productCategory",name:"productCategory.category_name"}
  //   ]
  // });
});
</script>
@endpush
