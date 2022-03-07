@include('owner.components.header')
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  @include('owner.components.navbar')

  @include('owner.components.sidebar')

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
  @include('owner.components.footer')
  <!-- /.control-sidebar -->
</div>
@include('owner.components.script')
