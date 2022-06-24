@extends('layouts.master')

@section('breadcrumb')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <a href="/employee/commission" class="btn btn-warning"><i class="fas fa-arrow-left"></i> Kembali</a>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item active">Karyawan</li>
          <li class="breadcrumb-item active">Komisi</li>
          <li class="breadcrumb-item active">Track Record</li>
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
    <h3 class="m-0">Track Record Karyawan : {{$employee_data->employee_fullname}}</h3>
    <div class="card mt-3">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table data-commission table-hover table-striped">
              <thead class="bg-dark">
                <tr>
                  <th>#</th>
                  <th>Tanggal</th>
                  <th>Pekerjaan</th>
                  <th>Komisi (Rp)</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($workDetail_data as $workDetail)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$workDetail->date ? with(new \Carbon\Carbon($workDetail->date))->isoFormat('dddd, D MMMM Y')/*->diffForHumans()*/ : '';}}</td>
                        <td>{{$workDetail->transactionDetail->product->product_name}}</td>
                        <td>{{$workDetail->commission}}</td>
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
});
</script>
@endpush
