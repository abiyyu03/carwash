@extends('layouts.master')
@section('breadcrumb')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">{{ $transaction_data->customer->customer_license_plate }} - {{ $transaction_data->customer->customer_name}}</h1>
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
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <form action="{{route('transaction.storeTransactionDetail')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="transaction_id" value="{{request()->route('id_transaction')}}">
                        <label for="product_category_id">Kategori Produk</label>
                        <select name="product_category_id" class="form-control">
                            <option>-</option>
                            @foreach($productCategory_data as $productCategory)
                            <option value="{{$productCategory->id_product_category}}">{{$productCategory->category_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="product_id">Nama Produk</label>
                        <select name="product_id" id="product_id" class="form-control">
                            <option value="1">Cuci Motor Kecil</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="transaction_detail_amount">Jumlah Produk</label>
                        <input name="transaction_detail_amount" type="number"min="1" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="employee_id">Nama Karyawan</label>
                        <select name="employee_id" id="employee_id" class="form-control">
                            <option>-</option>
                            @foreach($employee_data as $employee)
                            <option value="{{$employee->id_employee}}">{{$employee->employee_fullname}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <!-- <a href="" class="btn bg-maroon ml-2">Tambah</a> -->
                        <button type="submit" class="btn bg-maroon">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-8">
    <div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <p></p>
            <table class="table mb-4">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactionWhereHas_data as $transactionDetail)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $transactionDetail->product->product_name }}</td>
                        <td>{{ $transactionDetail->transaction_detail_amount }}</td>
                        <td>{{ $transactionDetail->transaction_detail_price }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body d-flex justify-content-end">
       <h3>Total: Rp.-</h3>
        <a href="" class="btn bg-maroon ml-2">Proses</a>
    </div>
</div>
</div>
</div>
</div>
</div>
@endsection
<script src="{{url('plugins/jquery/jquery.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#employee_id').select2();
        $('#product_id').select2();
    });
</script>