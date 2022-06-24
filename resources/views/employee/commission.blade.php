@extends('layouts.master')

@section('breadcrumb')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Komisi Karyawan</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item active"><a href="#">Karyawan</a></li>
          <li class="breadcrumb-item active">Komisi</li>
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
    <div class="col-lg-6 col-6">
      <!-- small box -->
      <div class="small-box bg-info">
        <div class="inner">
          <h4 class="font-weight-bold">0</h4>
          <p>Jumlah Karyawan</p>
        </div>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-6 col-6">
      <!-- small box -->
      <div class="small-box bg-success">
        <div class="inner">
          <!-- <h4>53<sup style="font-size: 20px">%</sup></h4> -->
          <h4 class="font-weight-bold">Rp. 0</h4>
          <p>Total Komisi</p>
        </div>
        {{-- <div class="icon">
          <i class="ion ion-ios-box-outline"></i>
        </div> --}}
      </div>
    </div>
    <!-- ./col -->
    
  </div>
  <div class="mt-3">
    <div class="">
      <div class="form-inline justify-content-between">
        <div class="form-inline justify-content-between">
          <div class="form-group ">
            {{-- <a href="" class="btn bg-info ml-2"><i class="fas fa-file-excel"></i> Excel</a>
            <a href="/employee/commission/export/pdf" class="btn bg-info ml-2"><i class="fas fa-file"></i> PDF</a> --}}
          </div>
        </div>
        <div class="form-group">
        </div>
        <div class="form-group">
          {{-- <div class="input-group mr-2">
            <div class="input-group-append">
              <div class="input-group-text bg-light">
                <span class="fas fa-filter mr-1"></span>
                Kategori 
              </div>
            </div>
            <select name="" id="status" class="form-control">
              <option value="">pilih kategori</option>
              @foreach ($productCategory_data as $productCategory)   
                <option value="{{$productCategory->id_product_category}}">{{$productCategory->category_name}}</option>
              @endforeach
            </select> 
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
  </div>
    <div class="card mt-3">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table data-commission">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nama Karyawan</th>
                  <th>NIP</th>
                  {{-- <th>Tanggal</th> --}}
                  <th>Total Komisi (Rp)</th>
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
@push('addon-scripts')
<script type="text/javascript">
$(document).ready(function(){
//   $('.data-commission').DataTable({
//     dom: 'Bfrtip',
//     buttons:[
//       'excel',
//       {
//         title:'Data Komisi karyawan',
//         extend: 'pdf',
//         customize: function (doc) {
//         doc.content[1].table.widths = 
//             Array(doc.content[1].table.body[0].length + 1).join('*').split('');
//       }
// }
//     ]
//   });
  $('.data-commission').DataTable({
    processing:true,
    serverSide:true,
    ajax:"{{route('commission.commissionJson')}}",
    columns:[
      // {data:"DT_Row_Index",name:"DT_Row_Index", orderable:false, searchable:false},
      {data:"DT_RowIndex",name:"DT_RowIndex", orderable:false, searchable:false},
      {data:"employee_fullname",name:"employee_fullname"},
      {data:"id_employee",name:"id_employee"},
      {data:"commission",name:"commission"},
      // {data:"action",name:"action"}
      {
        data:"id_employee",
        render: function(data,type,row){
          return '<a href="/employee/commission/track-record/'+data+'" class="btn btn-primary"><i class="fas fa-eye"></i> Lihat Track Record</a>';
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
    ],
    dom: 'Blfrtip',
    buttons: [
    'copyHtml5',
    'excelHtml5',
    'csvHtml5',
    {
      extend: 'pdfHtml5',
      messageTop:"Laporan Komisi",
      title:"Laporan Transaksi",
      filename:"Laporan-Harian-Jiwalu-Carwash",
      footer:true,
      header:true,
      autoWidth:true
    }
    ],
  });
});
</script>
@endpush
