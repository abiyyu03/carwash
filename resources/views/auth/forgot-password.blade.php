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
                <div class="alert alert-danger">
                    <p>
                        <i class="fas fa-times"></i>
                        {{$message}}
                    </p>
                </div>
                @endif
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="input-group mb-3">
                      <input type="email" class="form-control" placeholder="Email" name="email">
                      <div class="input-group-append">
                        <div class="input-group-text">
                          <span class="fas fa-envelope"></span>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn bg-info form-control">Kirim</button>
                    </div> 
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