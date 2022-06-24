@extends('layouts.master')
@section('breadcrumb')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="">
            <div class="">
                <div class="d-flex justify-content-between">
                    <a href="/transaction" class="btn bg-warning"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
                    <h3 class="m-0">{{ $transaction_data->customer->customer_license_plate }} - {{ $transaction_data->customer->customer_name}}</h3>
                    <a href="/transaction/delete/{{ $transaction_data->id_transaction }}" class="btn bg-danger"><i class="fas fa-trash"></i> Hapus Transaksi</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.content-header -->
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-info text-center">
                    <h5><i class="fas fa-cart-arrow-down text-white"></i> Masukan produk</h5>
                </div>
                <div class="card-body">
                    <form action="{{route('transaction.storeTransactionDetail')}}" method="POST">
                        @csrf
                        <input type="hidden" name="id_transaction_detail" value="{{rand()}}">
                        <input type="hidden" name="transaction_id" value="{{request()->route('id_transaction')}}">
                        <div class="form-group">
                            <label for="product_category_id">Kategori Produk <sup class="text-danger">*</sup></label>
                            <select name="product_category_id" id="product_category_id" required class="form-control" {{($transaction_data->transaction_status !== 'pending') ? 'disabled' : ''}}>
                                <option value="">-</option>
                                @foreach($productCategory_data as $productCategory)
                                <option value="{{$productCategory->id_product_category}}" id="{{$productCategory->productType->product_type}}" >{{$productCategory->category_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="product_id">Nama Produk <sup class="text-danger">*</sup></label>
                            <select name="product_id" id="product_id" class="form-control product_id" style="width:100%" required  {{($transaction_data->transaction_status !== 'pending') ? 'disabled' : ''}}>
                                <option value="">-</option>
                            </select>
                        </div>
                        <div class="form-group" id="amount">
                            <label for="text" class="col-form-label">Jumlah Produk</label> 
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-danger" id="btn-minus"><i class="fas fa-minus-circle"></i></button>
                                </div> 
                                <input id="transaction_detail_amount" value="1" min="1" name="transaction_detail_amount" type="number" readonly class="form-control"> 
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-primary" id="btn-plus"><i class="fas fa-plus-circle"></i></button>
                                </div>
                            </div>
                        </div> 
                        <div class="form-group" id="employee">
                            <label for="employee_id">Nama Karyawan</label>
                            <select name="employee_id[]" id="employee_id" class="form-control" style="width:100%" multiple>
                                <option value="" disabled>-</option>
                                @foreach($employee_data as $employee)
                                <option value="{{$employee->id_employee}}">{{$employee->employee_fullname}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mt-4" >
                            <button type="submit" class="btn bg-info form-control" {{($transaction_data->transaction_status !== 'pending') ? 'disabled' : ''}}><i class="fas fa-plus"></i> Tambah</button>
                        </div>
                        <a href="" id="refreshButton" class="text-center d-block mx-auto text-info">
                            <i class="fas fa-sync"></i>
                            Refresh data
                        </a>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-info text-center">
                    <h5><i class="fas fa-shopping-basket text-white"></i> Detail Transaksi</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table mb-4 text-center table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Produk</th>
                                    <th>Jumlah</th>
                                    <th>Sub-Total</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(session(request()->route('id_transaction')))
                                    @foreach (session(request()->route('id_transaction')) as $transactionDetail)
                                    @if (@$transactionDetail['transaction_id'] == request()->route('id_transaction'))
                                    @php
                                        $total += $transactionDetail['transaction_detail_total'];
                                    @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $transactionDetail['product_name'] }}</td>
                                        <td>{{ $transactionDetail['transaction_detail_amount'] }}</td>
                                        <td>{{ $transactionDetail['transaction_detail_total'] }}</td>
                                        <td><a href="/transaction/{{ $transactionDetail['transaction_id'] }}/detail/delete/{{ $transactionDetail['id_transaction_detail'] }}" class="btn btn-danger {{($transaction_data->transaction_status !== 'pending') ? 'disabled' : ''}}"><i class="fas fa-times"> </i> Hapus</a></td>
                                    </tr>
                                    @endif
                                    @endforeach
                                @else
                                    @foreach($transactionWhereHas_data as $transactionDetail)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $transactionDetail->product->product_name }}</td>
                                        <td>{{ $transactionDetail->transaction_detail_amount }}</td>
                                        <td>{{ $transactionDetail->transaction_detail_total }}</td>
                                        <td></td>
                                        {{-- <td><a href="/transaction/detail/delete/{{ $transactionDetail->id_transaction_detail }}" class="btn btn-danger {{($transaction_data->transaction_status !== 'pending') ? 'disabled' : ''}}"><i class="fas fa-times"> </i> Hapus</a></td> --}}
                                    </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body d-flex justify-content-end">
                        <h3 class="font-weight-bold">Total : Rp.{{ $total }}</h3>
                        <a href="" class="btn bg-info ml-2" data-toggle="modal" data-target="#structModal"><i class="fas fa-check"></i> Konfirmasi Transaksi</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="structModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Buat Transaksi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div> -->
                <div class="modal-body">
                    <div class="container bg-light px-3" id="printArea">
                        {{-- <div class="header">
                            <div class="mx-auto text-center">
                                <!-- <div class="img-brand mt-2">
                                    <img src="jiwalu-logo.png" width="60px" alt="" id="img-brand">
                                </div> -->
                                <div class="info-brand" style="margin:auto;display:block">
                                    <p class="mb-0 lead font-weight-bold">Jiwalu Carwash</p>
                                    <p class="small">Jalan Pancasila, Depok, Jawabarat, 21342</p>
                                </div>
                            </div>
                        </div>
                        <div class="title-brand">
                            <hr>
                            <p class="small">ID Transaksi : {{ $transaction_data->id_transaction }}</p>
                            <p class="small">Hari/Tanggal : {{ \Carbon\Carbon::parse($transaction_data->transaction_timestamp)->isoFormat('dddd, D MMMM Y') }}</p>
                            <p class="small">Pukul : {{ \Carbon\Carbon::parse($transaction_data->transaction_timestamp)->isoFormat('HH:mm') }} WIB</p>
                        </div> --}}
                        <div class="content">
                            <div class="table-responsive">
                                {{-- <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th class="small">#</th>
                                            <th class="small">Nama</th>
                                            <th class="small">Amount</th>
                                            <th class="small">Harga/pcs</th>
                                            <th class="small">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(session(request()->route('id_transaction')))
                                            @foreach (session(request()->route('id_transaction')) as $transactionDetail)
                                            @if (@$transactionDetail['transaction_id'] == request()->route('id_transaction'))
                                            @php
                                                $total += $transactionDetail['transaction_detail_total'];
                                            @endphp
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $transactionDetail['product_name'] }}</td>
                                                <td>{{ $transactionDetail['transaction_detail_amount'] }}</td>
                                                <td>{{ @$transactionDetail['product_price'] }}</td>
                                                <td>{{ $transactionDetail['transaction_detail_total'] }}</td>
                                            </tr>
                                            @endif
                                            @endforeach
                                        @else
                                            @foreach($transactionWhereHas_data as $transactionDetail)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $transactionDetail->product->product_name }}</td>
                                                <td>{{ $transactionDetail->transaction_detail_amount }}</td>
                                                <td>{{ $transactionDetail->product->product_price }}</td>
                                                <td>{{ $transactionDetail->transaction_detail_total }}</td>
                                            </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table> --}}
                                @if($transaction_data->transaction_status === 'pending')
                                <div class="form-group">
                                    <label for="product_name" class="col-form-label">Uang Cash</label>
                                    <input type="hidden" class="form-control" value="{{ $total }}" id="product_total">
                                    <input type="number" class="form-control" id="cash">
                                </div>
                                @endif
                                <div class="result text-left">
                                    {{-- <hr> --}}
                                    <p class="text-center">Perhitungan</p>
                                    <table class="table">
                                        <tr>
                                            <td class="small">Uang Cash</td>
                                            <td class="small"> : </td>
                                            <td class="small font-weight-bold">Rp. <span id="cashes">0</span></td>
                                        </tr>
                                        <tr>
                                            <td class="small">Kembalian</td>
                                            <td class="small"> : </td>
                                            <td class="small font-weight-bold">Rp. <span id="payback">0</span></td>
                                        </tr>
                                        <tr>
                                            <td class="small">Grand Total</td>
                                            <td class="small"> : </td>
                                            <td class="small font-weight-bold">Rp. <span id="grandtotal">{{ $total }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 text-right">
                            <a href="#" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">
                                <i class="fas fa-times"></i>
                                Tutup
                            </a>
                            @if($transaction_data->transaction_status === 'pending')
                            <a href="/transaction/{{$transaction_data->id_transaction}}/finish" onclick="printDiv()" id="finishPay" class="btn btn-info disabled">
                                <i class="fas fa-check-circle"></i>
                                Selesaikan Pembayaran
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        @media print {
            #printArea {
                width:3in;
                height:5in;
            }
        }
    </style>
    @endsection
    @push('addon-scripts')
    <script src="{{url('plugins/jquery/jquery.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function(){
            // $('#product_category_id').select2();
            $('#employee_id').select2();
            $('#product_id').select2();
            var i = 1;
            $('#amount').hide();
            $('#employee').hide();
            // transaction detail amount
            $('#btn-plus').on('click', function(){
                $('#transaction_detail_amount').val(++i);
            });
            $('#btn-minus').on('click', function(){
                if($('#transaction_detail_amount').val() > 1)
                {
                    $('#transaction_detail_amount').val(--i);
                }
            });
            
            $('#product_category_id').on('change',function(){
                var product_category_id = $(this).val();
                var div = $(this).parent();
                // var op = " ";
                // console.log($("#product_category_id option:selected").attr('id'));
                if ($("#product_category_id option:selected").attr('id') == "produk") {
                    $('#amount').show();
                    $('#employee').hide();
                } else {
                    $('#employee').show();
                    $('#amount').hide();
                }
                
                $.ajax({
                    type:'get',
                    url:'{!!URL::to('dropdownProduct')!!}',
                    dataType:'json',
                    data:{
                        id:product_category_id
                    },
                    success:function(data){
                        $('#product_id').empty();
                        $('#product_price').val("");
                        $('#product_id').append('<option selected value="" disabled>pilih produk</option>');
                            $.each(data,function(key, product_id){
                                $('#product_id').append('<option value="'+product_id.id_product+'">'+product_id.product_name+' - Rp.'+product_id.product_price+'</option>');
                            });
                        },
                    });
                });
                $('#product_id').on('change',function(){
                    var product_id = $(this).val();
                    
                    $.ajax({
                        type:'get',
                        url:'{!!URL::to('getProductProduct')!!}',
                        dataType:'json',
                        data:{
                            id:product_id
                        },
                        success:function(data){
                            $('#product_price').val("Rp. "+data.product_price);
                        },
                    });
                });
                
                $('#cash').on('keyup',function(){
                    //uang kembali
                    var total = $("#product_total").val();
                    var cash = $("#cash").val();
                    $("#payback").text(cash - total);

                    $("#cashes").text($("#cash").val());
                    $("#finishPay").attr("class","btn btn-info");
                });

                $('#refreshButton').on("click", function(){
                    $('#product_id').ajax.reload();
                    $('#product_category_id').ajax.reload();
                    // $.ajax({
                    //     type:'get',
                    //     url:'transaction/JWL202262261129/select-product',
                    //     dataType:'json',
                    //     data:{
                    //         id:product_id
                    //     },
                    //     success:function(data){
                    //         $('#product_id').ajax.reload();
                    //         $('#product_category_id').ajax.reload();
                    //     },
                    // });
                })
                
            });
            function printDiv()
            {
                let divContents = document.getElementById("printArea").innerHTML;
                let a = window.open('','','height=600, width=500');
                a.document.write('<html>');
                a.document.write('<head>');
                    // a.document.write('<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">');
                    a.document.write('</head>');
                    a.document.write('<body class="p-4">');
                        a.document.write(divContents);
                        a.document.write('</body></html>');
                        a.document.close();
                        a.print();
                    }
                </script>
                @endpush