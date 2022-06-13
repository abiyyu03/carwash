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
  <div class="row">
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-info">
        <div class="inner">
          <h4 class="font-weight-bold">{{count($workDetail_data)}}</h4>
          <p>Total Karyawan</p>
        </div>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-success">
        <div class="inner">
          <!-- <h4>53<sup style="font-size: 20px">%</sup></h4> -->
          <h4 class="font-weight-bold">Rp. {{ $totalCommission }}</h4>
          <p>Total Komisi</p>
        </div>
        {{-- <div class="icon">
          <i class="ion ion-ios-box-outline"></i>
        </div> --}}
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-success">
        <div class="inner">
          <!-- <h4>53<sup style="font-size: 20px">%</sup></h4> -->
          <h4 class="font-weight-bold">Rp. 0</h4>
          <p>Produk terjual</p>
        </div>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-success">
        <div class="inner">
          <!-- <h4>53<sup style="font-size: 20px">%</sup></h4> -->
          <h4 class="font-weight-bold">Rp. 0</h4>
          <p>Produk</p>
        </div>
      </div>
    </div>
  </div>
  <div class="card mt-3">
    <div class="card-body">
      <div class="form-inline justify-content-between">
        <div class="form-group ">
          {{-- <a href="" class="btn bg-maroon ml-2"><i class="fas fa-table"></i> Excel</a>
          <a href="" class="btn bg-maroon ml-2"><i class="fas fa-table"></i> PDF</a> --}}
        </div>
        <div class="form-group">
          <input type="date" name="" class="form-control" id="">
          <input type="date" name="" class="form-control ml-2" id="">
          <button type="submit" class="btn bg-info ml-2"><i class="fas fa-calendar"></i> Filter</button>
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
                  <th>Nama Panjang Karyawan</th>
                  <th>NIP</th>
                  <th>Tanggal</th>
                  <th>Total Komisi</th>
                  <!-- <th>Aksi</th> -->
                </tr>
              </thead>
              <tbody>
                @foreach($workDetail_data as $workDetail) 
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $workDetail->employee->employee_fullname}}</td>
                  <td>{{ $workDetail->employee->id_employee }}</td>
                  <td>{{ $workDetail->date}}</td>
                  <td>{{ $workDetail->commission }}</td>
                </tr> 
                @endforeach
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
