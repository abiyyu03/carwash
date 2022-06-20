@extends('layouts.master')

@section('breadcrumb')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Ringkasan Laporan </h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right"> 
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
            <input type="text" name="from_date" class="form-control" id="from_date" readonly>
          </div>
        </div>
      </div>
    </div>
  </div>
    <div class="card mt-3">
        <div class="card-body">
        <p>Ringkasan Laporan <span>Hari Ini</span></p>
          <div class="row">
            <div class="col-sm-12 col-md-4 table-responsive">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr class="bg-info">
                    <th>Pendapatan</th>
                    <!-- <th>Aksi</th> -->
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      <div class="d-flex justify-content-between">
                        <p class="mb-0">Laba Kotor</p>
                        <p class="mb-0">Rp. {{ $getTransactionTotal }}</p>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="d-flex justify-content-between">
                        <p class="mb-0">Laba bersih</p>
                        <p class="mb-0">Rp.300000</p>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="d-flex justify-content-between">
                        <p class="mb-0">Pendapatan Kotor</p>
                        <p class="mb-0">Rp.300000</p>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="col-sm-12 col-md-4 table-responsive">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th class="bg-info">Pengeluaran</th>
                    <!-- <th>Aksi</th> -->
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Pengeluaran Hari Ini</td>
                    <p class="mb-0">Rp.300000</p>
                  </tr>
                  <tr>
                    <td>Pengeluaran Bulan Ini</td>
                  </tr>
                  <tr>
                    <td>asldkasjl</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="col-sm-12 col-md-4 table-responsive">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th class="bg-info">Laporan Karyawan</th>
                    <!-- <th>Aksi</th> -->
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      <div class="d-flex justify-content-between">
                        <p class="mb-0">Karyawan masuk</p>
                        <p class="mb-0 font-weight-bold">20</p>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="d-flex justify-content-between">
                        <p class="mb-0">Karyawan tidak masuk</p>
                        <p class="mb-0 font-weight-bold">20</p>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="d-flex justify-content-between">
                        <p class="mb-0">Komisi karyawan</p>
                        <p class="mb-0 font-weight-bold">Rp. 20.000</p>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
    </div>
</div>
@endsection
@push('addon-scripts')
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
  $('#from_date').daterangepicker({
    opens: 'left'
  }, function(start, end, label) {
    var from_date = start.format('YYYY-MM-DD'); 
    var to_date = end.format('YYYY-MM-DD');
    if(from_date != '' && to_date != '')
    {
      $('.data-report').DataTable().destroy();
      loadData(from_date,to_date);
    } else {
      alert('Both Date is required');
    }
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
