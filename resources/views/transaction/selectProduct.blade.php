@extends('layouts.master')
@section('breadcrumb')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Dashboard</h1>
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
@php
    $arr1 = ['nama_service' => 'Cuci + Foging'];
    $arr2 = ['nama_service' => 'Cuci + Wax'];
    $arr3 = ['nama_service' => 'Cuci + Minum'];
    $arr4 = ['nama_service' => 'Cuci + Foging'];
    $arr5 = ['nama_service' => 'Cuci + Wax'];
    $arr6 = ['nama_service' => 'Cuci + Minum'];
    $arr = [$arr1,$arr2,$arr3,$arr4,$arr5,$arr6];
    @endphp
    
<div class="container-fluid">
<div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text">
            <i class="fa fa-filter"></i>
          </div>
        </div> 
         <select name="vehicle_type_id" class="form-control">
        <option value="">Lambhorgini</option>
    </select>
      </div>    
	<div class="row">
  @foreach ($arr as $a)
		<div class="col-md-3 col-sm-6">
			<div class="card">
				<h5 class="card-header">
					Card title
				</h5>
				<div class="card-body">
					<p class="card-text">
          {{$a['nama_service']}}
					</p>
				</div>
				<div class="card-footer">
					Card footer
				</div>
			</div>
		</div>
		@endforeach
		
	</div>
  <a href="/transaction/checkout" class="btn bg-maroon">Simpan dan lanjutkan</a>
</div>
@endsection