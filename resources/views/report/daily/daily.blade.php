@extends('layouts.master')

@section('breadcrumb')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Laporan Harian</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Laporan</li>
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
          <h4 class="font-weight-bold">Rp. {{ $total }}</h4>
          <p>Total Penjualan</p>
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
          <p>Laba Bersih</p>
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
          <h4 class="font-weight-bold">{{ $soldProduct }}</h4>
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
        <table class="table data-report">
          <thead>
            <tr>
              <th>#</th>
              <th>Nama produk</th>
              <th>Jumlah</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
            @foreach($transactionDetail_data as $transactionDetail)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $transactionDetail->product->product_name }}</td>
              <td>{{ $transactionDetail->transaction_detail_amount }}</td>
              <td>{{ $transactionDetail->transaction_detail_total }}</td>
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
  $(document).ready(function () {
    $('.data-report').DataTable();
  });
</script>
@endpush