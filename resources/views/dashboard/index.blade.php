@extends('layouts.master')

@section('content')
<div class="container-fluid">
  <!-- Small boxes (Stat box) -->
  <div class="row">
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-info">
        <div class="inner">
          <h3>{{ count($transaction_data) }}</h3>
          
          <p>Transaksi</p>
        </div>
        <div class="icon">
          <i class="ion ion-bag"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-success">
        <div class="inner">
          <!-- <h3>53<sup style="font-size: 20px">%</sup></h3> -->
          <h3>{{ count($product_data) }}</h3>
          <p>Produk</p>
        </div>
        <div class="icon">
          <i class="ion ion-ios-box-outline"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-warning">
        <div class="inner">
          <h3>44</h3>
          
          <p>Karyawan</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-danger">
        <div class="inner">
          <h3>65</h3>
          
          <p>Pendapatan Kotor</p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
  </div>
  <!-- /.row -->
  <!-- Main row -->
  <div class="row">
    <!-- Left col -->
    <section class="col-lg-7 connectedSortable">
      <!-- Custom tabs (Charts with tabs)-->
      
      <!-- Map card -->
      <div class="card bg-gradient-primary overflow-auto" style="max-height:500px">
        <div class="card-header border-0">
          <h3 class="card-title">
            <i class="fas fa-tasks mr-1"></i>
            {{(!count($transactionPending_data)) ? 'Tidak ada antrian' : 'Menunggu di proses'}}
          </h3>
          <!-- card tools -->
          <div class="card-tools">
            <button type="button" class="btn btn-primary btn-sm daterange" title="Date range">
              <i class="far fa-calendar-alt"></i>
            </button>
            <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
          <!-- /.card-tools -->
        </div>
        <div class="card-body">
          <ul class="list-group list-group-light">
            @foreach($transactionPending_data as $transaction)
            @if($transaction->transaction_status === "pending")
            <a href="/transaction/{{ $transaction->id_transaction }}/select-product" class=" px-3 border-0 rounded-3 mb-2">
              <li class="list-group-item list-group-item-action d-flex justify-content-between list-group-item-warning align-items-center">
                <div>
                  <div class="fw-bold text-dark">{{ $transaction->customer->customer_license_plate }}</div>
                  <div class="text-muted">{{ $transaction->customer->customer_name }}</div>
                </div>
                <span class="badge rounded-pill badge-warning p-2">{{ $transaction->transaction_status }}</span>
              </li>
            </a>
            @endif
            @endforeach
            
            <!-- <li class="list-group-item d-flex justify-content-between align-items-center">
              <div>
                <div class="fw-bold text-dark">Alex Ray</div>
                <div class="text-muted">alex.ray@gmail.com</div>
              </div>
              <span class="badge rounded-pill badge-primary">Onboarding</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              <div>
                <div class="fw-bold text-dark">Kate Hunington</div>
                <div class="text-muted">kate.hunington@gmail.com</div>
              </div>
              <span class="badge rounded-pill badge-warning">Pending</span>
            </li> -->
          </ul>
        </div>
        <!-- /.card-body-->
        {{-- <div class="card-footer bg-transparent">
          <div class="row">
            <div class="col-4 text-center">
              <div id="sparkline-1"></div>
              <div class="text-white">Visitors</div>
            </div>
            <!-- ./col -->
            <div class="col-4 text-center">
              <div id="sparkline-2"></div>
              <div class="text-white">Online</div>
            </div>
            <!-- ./col -->
            <div class="col-4 text-center">
              <div id="sparkline-3"></div>
              <div class="text-white">Sales</div>
            </div>
            <!-- ./col -->
          </div>
          <!-- /.row -->
        </div> --}}
      </div>
      <!-- /.card -->
      
      <div class="card">
        {{-- <div class="card-header">
          <h3 class="card-title">
            <i class="fas fa-chart-pie mr-1"></i>
            Sales
          </h3>
          <div class="card-tools">
            <ul class="nav nav-pills ml-auto">
              <li class="nav-item">
                <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Area</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#sales-chart" data-toggle="tab">Donut</a>
              </li>
            </ul>
          </div>
        </div><!-- /.card-header --> --}}
        <div class="card-body">
          <div class="tab-content p-0">
            <!-- Morris chart - Sales -->
            <div class="chart tab-pane active" id="revenue-chart"
            style="position: relative; height: 300px;">
            <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>
          </div>
          {{-- <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;"> --}}
            {{-- <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas> --}}
            <div id="stocks-chart"></div>
            {!!Lava::render('LineChart', 'MyStocks', 'stocks-chart')!!}
          {{-- </div> --}}
        </div>
      </div><!-- /.card-body -->
    </div>
    <!-- /.card -->
    <!-- DIRECT CHAT -->
    <div class="card direct-chat direct-chat-primary">
      {{-- <div class="card-header">
        <h3 class="card-title">Direct Chat</h3>
        
        <div class="card-tools">
          <span title="3 New Messages" class="badge badge-primary">3</span>
          <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" title="Contacts" data-widget="chat-pane-toggle">
            <i class="fas fa-comments"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
      
      <!-- TO DO List -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">
            <i class="ion ion-clipboard mr-1"></i>
            To Do List
          </h3>
          
          <div class="card-tools">
            <ul class="pagination pagination-sm">
              <li class="page-item"><a href="#" class="page-link">&laquo;</a></li>
              <li class="page-item"><a href="#" class="page-link">1</a></li>
              <li class="page-item"><a href="#" class="page-link">2</a></li>
              <li class="page-item"><a href="#" class="page-link">3</a></li>
              <li class="page-item"><a href="#" class="page-link">&raquo;</a></li>
            </ul>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <ul class="todo-list" data-widget="todo-list">
            <li>
              <!-- drag handle -->
              <span class="handle">
                <i class="fas fa-ellipsis-v"></i>
                <i class="fas fa-ellipsis-v"></i>
              </span>
              <!-- checkbox -->
              <div  class="icheck-primary d-inline ml-2">
                <input type="checkbox" value="" name="todo1" id="todoCheck1">
                <label for="todoCheck1"></label>
              </div>
              <!-- todo text -->
              <span class="text">Design a nice theme</span>
              <!-- Emphasis label -->
              <small class="badge badge-danger"><i class="far fa-clock"></i> 2 mins</small>
              <!-- General tools such as edit or delete-->
              <div class="tools">
                <i class="fas fa-edit"></i>
                <i class="fas fa-trash-o"></i>
              </div>
            </li>
            <li>
              <span class="handle">
                <i class="fas fa-ellipsis-v"></i>
                <i class="fas fa-ellipsis-v"></i>
              </span>
              <div  class="icheck-primary d-inline ml-2">
                <input type="checkbox" value="" name="todo2" id="todoCheck2" checked>
                <label for="todoCheck2"></label>
              </div>
              <span class="text">Make the theme responsive</span>
              <small class="badge badge-info"><i class="far fa-clock"></i> 4 hours</small>
              <div class="tools">
                <i class="fas fa-edit"></i>
                <i class="fas fa-trash-o"></i>
              </div>
            </li>
            <li>
              <span class="handle">
                <i class="fas fa-ellipsis-v"></i>
                <i class="fas fa-ellipsis-v"></i>
              </span>
              <div  class="icheck-primary d-inline ml-2">
                <input type="checkbox" value="" name="todo3" id="todoCheck3">
                <label for="todoCheck3"></label>
              </div>
              <span class="text">Let theme shine like a star</span>
              <small class="badge badge-warning"><i class="far fa-clock"></i> 1 day</small>
              <div class="tools">
                <i class="fas fa-edit"></i>
                <i class="fas fa-trash-o"></i>
              </div>
            </li>
            <li>
              <span class="handle">
                <i class="fas fa-ellipsis-v"></i>
                <i class="fas fa-ellipsis-v"></i>
              </span>
              <div  class="icheck-primary d-inline ml-2">
                <input type="checkbox" value="" name="todo4" id="todoCheck4">
                <label for="todoCheck4"></label>
              </div>
              <span class="text">Let theme shine like a star</span>
              <small class="badge badge-success"><i class="far fa-clock"></i> 3 days</small>
              <div class="tools">
                <i class="fas fa-edit"></i>
                <i class="fas fa-trash-o"></i>
              </div>
            </li>
            <li>
              <span class="handle">
                <i class="fas fa-ellipsis-v"></i>
                <i class="fas fa-ellipsis-v"></i>
              </span>
              <div  class="icheck-primary d-inline ml-2">
                <input type="checkbox" value="" name="todo5" id="todoCheck5">
                <label for="todoCheck5"></label>
              </div>
              <span class="text">Check your messages and notifications</span>
              <small class="badge badge-primary"><i class="far fa-clock"></i> 1 week</small>
              <div class="tools">
                <i class="fas fa-edit"></i>
                <i class="fas fa-trash-o"></i>
              </div>
            </li>
            <li>
              <span class="handle">
                <i class="fas fa-ellipsis-v"></i>
                <i class="fas fa-ellipsis-v"></i>
              </span>
              <div  class="icheck-primary d-inline ml-2">
                <input type="checkbox" value="" name="todo6" id="todoCheck6">
                <label for="todoCheck6"></label>
              </div>
              <span class="text">Let theme shine like a star</span>
              <small class="badge badge-secondary"><i class="far fa-clock"></i> 1 month</small>
              <div class="tools">
                <i class="fas fa-edit"></i>
                <i class="fas fa-trash-o"></i>
              </div>
            </li>
          </ul>
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
          <button type="button" class="btn btn-primary float-right"><i class="fas fa-plus"></i> Add item</button>
        </div>
      </div> --}}
      <!-- /.card -->
    </section>
    <!-- /.Left col -->
    <!-- right col (We are only adding the ID to make the widgets sortable)-->
    <section class="col-lg-5 connectedSortable">
      
      
      
      <!-- solid sales graph -->
      <div class="card bg-gradient-info">
        <div class="card-header border-0">
          <h3 class="card-title">
            <i class="fas fa-th mr-1"></i>
            Stok Produk Menipis
          </h3>
          
          <div class="card-tools">
            <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <!-- <canvas class="chart" id="line-chart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas> -->
          @foreach($product_data as $product)
          @if($product->product_stock <= $product->product_minimum_stock && $product->productCategory->productType->product_type == "produk")
          <a href="/transaction/{{ $transaction->id_transaction }}/select-product" class=" px-3 border-0 rounded-3 mb-2">
            <li class="list-group-item list-group-item-action d-flex justify-content-between list-group-item-info align-items-center">
              <div>
                <div class="fw-bold text-dark font-weight-bold">{{ $product->product_name }}</div>
                <div class=""></b>Sisa Stok : {{ $product->product_stock }}</div>
              </div>
              <!-- <span class="badge rounded-pill badge-warning p-2"></span> -->
            </li>
          </a>
          @endif
          @endforeach
        </div>
      </div>
      <!-- /.card -->
      
      <!-- Calendar -->
      <div class="card bg-gradient-success">
        <div class="card-header border-0">
          
          <h3 class="card-title">
            <i class="far fa-calendar-alt"></i>
            Calendar
          </h3>
          <!-- tools card -->
          <div class="card-tools">
            <!-- button with a dropdown -->
            <div class="btn-group">
              <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" data-offset="-52">
                <i class="fas fa-bars"></i>
              </button>
              <div class="dropdown-menu" role="menu">
                <a href="#" class="dropdown-item">Add new event</a>
                <a href="#" class="dropdown-item">Clear events</a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">View calendar</a>
              </div>
            </div>
            <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
          <!-- /. tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body pt-0">
          <!--The calendar -->
          <div id="calendar" style="width: 100%"></div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </section>
    <!-- right col -->
  </div>
  <!-- /.row (main row) -->
</div>
<script src="https://www.gstatic.com/charts/loader.js"></script>
<script>
    window.google.charts.load('46', {packages: ['corechart']});
</script>
@endsection