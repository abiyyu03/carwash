<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>JIWALU CARWASH | Log in </title>
  
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-info">
      <div class="card-header text-center">
        <a href="/" class="h1"><b>Jiwalu </b>Carwash</a>
      </div>
      <div class="card-body">
        @if($message = Session::get('status'))
        <div class="alert alert-success">
          <p>
            <i class="fas fa-check"></i>
            {{$message}}
          </p>
        </div>
        @endif
        <form action="{{route('logins.login')}}" method="post">
          @csrf
          <div class="input-group mb-3">
            <input type="email" class="form-control" placeholder="Email" value="{{ old('email')}}" name="email" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password" name="password" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <!-- <div class="col-8">
            </div> -->
            <!-- /.col -->
            <div class="col-12">
              <button type="submit" class="btn bg-info form-control">Masuk</button>
            </div> 
            <!-- /.col -->
          </div>
          <div class="text-center mt-2">
            <a href="/forgot-password" class="text-info">Lupa Password</a>
            {{-- <a href="/register" class="text-info">Registrasi</a> --}}
          </div>
          @include('sweetalert::alert')
        </form>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.login-box -->
  <!-- jQuery -->
  <script src="../../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../../dist/js/adminlte.min.js"></script>
</body>
</html>