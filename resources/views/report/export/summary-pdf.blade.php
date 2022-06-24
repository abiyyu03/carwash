<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
  <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
  <title>Document</title>
  <style>
    .card{
      background-color:whitesmoke;  
    }
    table,,th,td{
      border:1px solid #000;
    }
    .row {
      width:100%;
      display:inline-block
    }
    .d-flex .table-responsive{
      display:flex;
    }
    .justify-content-between {
      justify-content: space-between
    }
  </style>
</head>
<body>
<div class="container-fluid">
    <div class="card mt-3">
        <div class="card-body">
        <p>Ringkasan Laporan <span>Hari Ini</span></p>
          <div class="row">
            <div class="col-sm-12 col-md-4 table-responsive">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr class="bg-info">
                    <th><i class="fas fa-money-bill-alt"></i> Pendapatan</th>
                    <!-- <th>Aksi</th> -->
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      <div class="d-flex justify-content-between">
                        <p class="mb-0">Produk Terjual</p>
                        <p class="mb-0 font-weight-bold">{{$transactionDetailProduk_total}}</p>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="d-flex justify-content-between">
                        <p class="mb-0">Kendaraan dicuci</p>
                        <p class="mb-0 font-weight-bold">{{$transactionDetailServis_total}}</p>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="d-flex justify-content-between">
                        <p class="mb-0">Total Pelanggan</p>
                        <p class="mb-0 font-weight-bold">{{$customer}}</p>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="d-flex justify-content-between">
                        <p class="mb-0">Laba Kotor</p>
                        <p class="mb-0 font-weight-bold">Rp. {{$transactionDetail_total}}</p>
                      </div>
                    </td>
                  </tr>
                    <th class="bg-secondary">
                      <div class="d-flex justify-content-between">
                        <p class="mb-0">Pendapatan Bersih</p>
                        <p class="mb-0 font-weight-bold">{{ $attendance_present }}</p>
                      </div>
                    </th>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="col-sm-12 col-md-4 table-responsive">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th class="bg-info"><i class="fas fa-money-bill-wave"></i> Pengeluaran</th>
                    <!-- <th>Aksi</th> -->
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      <div class="d-flex justify-content-between">
                        <p class="mb-0">Fix Cost</p>
                        <p class="mb-0 font-weight-bold">{{ $fixCost }}</p>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="d-flex justify-content-between">
                        <p class="mb-0">Variable Cost</p>
                        <p class="mb-0 font-weight-bold">{{ $variableCost }}</p>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="d-flex justify-content-between">
                        <p class="mb-0">Komisi karyawan</p>
                        <p class="mb-0 font-weight-bold">Rp. {{$workDetail_commission}}</p>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <th class="bg-secondary">
                      <div class="d-flex justify-content-between">
                        <p class="mb-0">Total Pengeluaran</p>
                        <p class="mb-0 font-weight-bold">{{ $attendance_present }}</p>
                      </div>
                    </th>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="col-sm-12 col-md-4 table-responsive">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th class="bg-info"><i class="fas fa-users"></i> Laporan Karyawan</th>
                    <!-- <th>Aksi</th> -->
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      <div class="d-flex justify-content-between">
                        <p class="mb-0">Karyawan masuk</p>
                        <p class="mb-0 font-weight-bold">{{ $attendance_attend }}</p>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="d-flex justify-content-between">
                        <p class="mb-0">Karyawan tidak masuk</p>
                        <p class="mb-0 font-weight-bold">{{ $attendance_present }}</p>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <th class="bg-secondary">
                      <div class="d-flex justify-content-between">
                        <p class="mb-0">Karyawan tidak masuk</p>
                        <p class="mb-0 font-weight-bold">{{ $attendance_present }}</p>
                      </div>
                    </th>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
    </div>
</div>  
</body>
</html>

