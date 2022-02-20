@include('cashier.components.header')
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  @include('cashier.components.navbar')

  @include('cashier.components.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @yield('breadcrumb')
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        
        <!-- Main row -->
        <div class="row">
          @yield('content')
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @include('cashier.components.footer')
  <!-- /.control-sidebar -->
</div>
@include('cashier.components.script')
