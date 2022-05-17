<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Jiwalu Carwash | Register</title>

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
  <div class="card card-outline card-maroon">
    <div class="card-header text-center">
      <a href="/cashier" class="h1"><b>Jiwalu </b>Carwash</a>
      <p>Registrasi Akun</p>
    </div>
    <div class="card-body">
    @if($message = Session::get('message'))
        <div class="alert alert-danger">
            <p>
              <i class="fas fa-times"></i>
               {{$message}}
            </p>
        </div>
    @endif
    <form action="{{route('registers.register')}}" method="post">
        @csrf
        <div class="form-group">
            <label for="customer_name">Nama Lengkap</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="role_id">Role</label>
            <select name="role_id" class="form-control" required>
              <option>-</option>
              @foreach($role_data as $role)
              <option value="{{$role->id_role}}">{{$role->role_name}}</option>
              @endforeach
            </select>
        </div>
        <div class="form-group d-flex justify-content-end">
            <button class="bg-maroon btn" type="submit">Daftarkan</button>
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