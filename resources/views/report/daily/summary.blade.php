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
  <div class="mt-3">
    <div class="">
      <div class="form-inline justify-content-between">
        <div class="form-group ">
          {{-- <a href="" class="btn bg-info ml-2"><i class="fas fa-file-excel"></i> Excel</a>
          <a href="/report/summary/pdf" class="btn bg-info ml-2"><i class="fas fa-file"></i> PDF</a> --}}
        </div>
        {{-- <div class="form-group">
          <div class="input-group">
            <div class="input-group-append">
              <div class="input-group-text bg-light">
                <span class="fas fa-calendar"></span> 
              </div>
            </div>
            <input type="text" name="filter_date" class="form-control" id="filter_date" readonly>
          </div>
        </div> --}}
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
  </div>
    <div class="card mt-3">
        <div class="card-body">
        <p>Ringkasan Laporan <span>Hari Ini</span></p>
          <div class="row">
            <div class="col-sm-12 col-md-4 table-responsive">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr class="bg-info">
                    <th><i class="fas fa-money-bill-alt"></i> Pendapatan</th>
                    <!-- <th>Aksi</th> -->
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      <div class="d-flex justify-content-between">
                        <p class="mb-0">Produk Terjual</p>
                        <p class="mb-0 font-weight-bold" id="produk-terjual"></p>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="d-flex justify-content-between">
                        <p class="mb-0">Kendaraan dicuci</p>
                        <p class="mb-0 font-weight-bold" id="kendaraan-dicuci"></p>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="d-flex justify-content-between">
                        <p class="mb-0">Total Pelanggan</p>
                        <p class="mb-0 font-weight-bold" id="total-pelanggan"></p>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="d-flex justify-content-between">
                        <p class="mb-0">Laba Kotor</p>
                        <p class="mb-0 font-weight-bold" id="laba-kotor"></p>
                      </div>
                    </td>
                  </tr>
                    <th class="table-secondary">
                      <div class="d-flex justify-content-between">
                        <p class="mb-0">Pendapatan Bersih</p>
                        <p class="mb-0 font-weight-bold" id="pendapatan-bersih"></p>
                      </div>
                    </th>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="col-sm-12 col-md-4 table-responsive">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th class="bg-info"><i class="fas fa-money-bill-wave"></i> Pengeluaran</th>
                    <!-- <th>Aksi</th> -->
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      <div class="d-flex justify-content-between">
                        <p class="mb-0">Fix Cost</p>
                        <p class="mb-0 font-weight-bold" id="fix-cost"></p>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="d-flex justify-content-between">
                        <p class="mb-0">Variable Cost</p>
                        <p class="mb-0 font-weight-bold" id="variable-cost"></p>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="d-flex justify-content-between">
                        <p class="mb-0">Komisi karyawan</p>
                        <p class="mb-0 font-weight-bold" id="komisi-karyawan"></p>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <th class="table-secondary">
                      <div class="d-flex justify-content-between">
                        <p class="mb-0">Total Pengeluaran</p>
                        <p class="mb-0 font-weight-bold" id="total-pengeluaran"></p>
                      </div>
                    </th>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="col-sm-12 col-md-4 table-responsive">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th class="bg-info"><i class="fas fa-users"></i> Laporan Karyawan</th>
                    <!-- <th>Aksi</th> -->
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      <div class="d-flex justify-content-between">
                        <p class="mb-0">Karyawan masuk</p>
                        <p class="mb-0 font-weight-bold" id="karyawan-masuk"></p>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="d-flex justify-content-between">
                        <p class="mb-0">Karyawan tidak masuk</p>
                        <p class="mb-0 font-weight-bold" id="karyawan-tidak-masuk"></p>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <th class="table-secondary">
                      <div class="d-flex justify-content-between">
                        <p class="mb-0">Total Karyawan</p>
                        <p class="mb-0 font-weight-bold" id="total-karyawan"></p>
                      </div>
                    </th>
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
  let money = $(".money").text();
  console.log(money);
  new Intl.NumberFormat('ID', { style: 'currency', currency: 'IDR' }).format(money);
  // new Intl.NumberFormat('id', {
  //   style: 'currency',
  //   currency: 'IDR',
  //   // minimumFractionDigits: 2
  // });
  // formatter.format($(".money").text());
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
  // $("#customer_license_plate").val(val.customer_license_plate);
  // var customer_license = $("#customer_license_plate").val();
  loadData();
  function loadData(from_date = '', to_date = ''){
    $.ajax({
    url:"{{route('summary.index')}}",
    cache:true,
    data:{from_date:from_date,to_date:to_date},
    success:function(data){
      console.log(data);
      var json = data;
      obj = JSON.parse(json);
      //pendapatan
      let pendapatanBersih = parseInt(obj.transactionDetail_total) - parseInt(obj.allTypeCost) - parseInt(obj.workDetail_commission)
      $("#produk-terjual").text(obj.transactionDetailProduk_total);
      $("#kendaraan-dicuci").text(obj.transactionDetailServis_total);
      $("#total-pelanggan").text(obj.customer);
      $("#laba-kotor").text("Rp. "+obj.transactionDetail_total);
      $("#pendapatan-bersih").text("Rp. "+pendapatanBersih);

      //pengeluaran
      let totalPengeluaran = parseInt(obj.allTypeCost) + parseInt(obj.workDetail_commission);
      $("#fix-cost").text("Rp. "+obj.fixCost);
      $("#variable-cost").text("Rp. "+obj.variableCost);
      $("#komisi-karyawan").text("Rp. "+obj.workDetail_commission);
      $("#total-pengeluaran").text("Rp. "+totalPengeluaran);

      //karyawan
      $("#karyawan-masuk").text(obj.attendance_attend);
      $("#karyawan-tidak-masuk").text(obj.attendance_present);
      $("#total-karyawan").text(obj.attendance_attend);

    },
    });
  }
  $('#filter').click(function(){
    var from_date = $('#from_date').val();
    var to_date = $('#to_date').val();
    if(from_date != '' && to_date != '')
    {
      // alert("AHAY");
      // $("#produk-terjual").text('');
      // $("#kendaraan-dicuci").text('');
      // $("#total-pelanggan").text('');
      // $("#laba-kotor").text('');
      // $("#pendapatan-bersih").text('');

      // //pengeluaran
      // let totalPengeluaran = parseInt('') + parseInt('');
      // $("#fix-cost").text('');
      // $("#variable-cost").text('');
      // $("#komisi-karyawan").text('');
      // $("#total-pengeluaran").text('');

      // //karyawan
      // $("#karyawan-masuk").text('');
      // $("#karyawan-tidak-masuk").text('');
      // $("#total-karyawan").text('');
      loadData(from_date,to_date);
    } else {
      alert('Both Date is required');
    }
  });
  //           'workDetail_commission' => $workDetail_commission
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
