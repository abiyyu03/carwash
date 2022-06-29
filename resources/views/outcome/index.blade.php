@extends('layouts.master')
@section('breadcrumb')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Pengeluaran</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Pengeluaran</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
@endsection
@section('content')
<div class="container-fluid">
  <div class=" d-flex justify-content-end">
      <button type="button" class="btn bg-info" data-toggle="modal" data-target="#exampleModal">
          <i class="fas fa-plus"></i>
          Buat Pengeluaran
      </button>
    </div>
    <div class="card mt-3">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table data-outcome">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Kebutuhan</th>
                  <th>Jumlah</th>
                  <th>Tanggal</th>
                  <th>Pengeluaran (Rp)</th>
                  <th>Tipe Pengeluaran</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($outcome_data as $outcome)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $outcome->needs }}</td>
                      <td>{{ $outcome->quantity }}</td>
                      <td>{{ $outcome->outcome_date ? with(new \Carbon\Carbon($outcome->outcome_date))->isoFormat('dddd, D MMMM Y') : '' }}</td>
                      <td>{{ $outcome->expense_balance }}</td>
                      <td>{{ ($outcome->outcomeType->outcome_type == "fix_cost") ? "Fix Cost" : "Variabel Cost" }}</td>
                      <td><a href="#" data-id="{{$outcome->id_outcome}}" class="btn btn-info editButton" id="editButton"><i class="fas fa-pencil-alt"></i> Edit</a>
                        <a href="/outcome/delete/{{$outcome->id_outcome}}" class="btn btn-danger" id="deleteButton"><i class="fas fa-trash-alt"></i> Hapus</a></td>
                    </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Pengeluaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{route('outcome.store')}}">
          @csrf
            <div class="form-group">
                <label for="needs" class="col-form-label">Kebutuhan</label>
                <input type="text" class="form-control" id="" name="needs" required>
            </div>
            <div class="form-group">
                <label for="quantity" class="col-form-label">quantity</label>
                <input type="text" class="form-control" id="" name="quantity">
            </div>
            <div class="form-group">
                <label for="expense_balance" class="col-form-label">Pengeluaran (Rp) </label>
                <input type="number" class="form-control" id="" name="expense_balance" required>
            </div>
            <div class="form-group">
                <label for="outcome_type" class="col-form-label">Jenis Pengeluaran </label>
                <select name="outcome_type_id" id="outcome_type_id" class="form-control">
                  <option value="" disabled selected></option>
                  <option value="1">Fix Cost</option>
                  <option value="2">Variable Cost</option>
                </select>
            </div>
            {{-- <div class="form-group">
                <label for="outcome_type" class="col-form-label">Jangka Waktu Pengeluaran</label>
                <select name="outcome_type" id="outcome_range" class="form-control">
                  <option value="" disabled selected>-</option>
                  <option value="daily">Setiap Hari</option>
                  <option value="weekly">Setiap Minggu</option>
                  <option value="monthly">Setiap Bulan</option>
                  <option value="everySixMonth">Setiap 6 Bulan</option>
                </select>
            </div> --}}

            <div class="modal-footer form-group">
                <button type="submit" class="btn btn-info">Tambah Pengeluaran</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- edit data -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Pengeluaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="" id="editForm">
          @csrf
          {{method_field('PUT')}}
            <div class="form-group">
                <label for="needs" class="col-form-label">Kebutuhan</label>
                <input type="text" class="form-control" id="edit_needs" name="needs" required>
            </div>
            <div class="form-group">
                <label for="quantity" class="col-form-label">quantity</label>
                <input type="text" class="form-control" id="edit_quantity" name="quantity" required>
            </div>
            <div class="form-group">
                <label for="expense_balance" class="col-form-label">Pengeluaran (Rp) </label>
                <input type="text" class="form-control" id="edit_expense_balance" name="expense_balance" required>
            </div>
            <div class="form-group">
                <label for="outcome_type" class="col-form-label">Jenis Pengeluaran </label>
                <select name="outcome_type" id="edit_outcome_type_id" class="form-control">
                  <option value="" disabled selected></option>
                  <option value="fix_cost">Fix Cost</option>
                  <option value="variable_cost">Variable Cost</option>
                </select>
            </div>
            <div class="modal-footer form-group">
                <button type="submit" class="btn btn-info">Edit Pengeluaran</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
@push('addon-scripts')
<script type="text/javascript">
$(document).ready(function(){
  var table = $('.data-outcome').DataTable();
  // $('#editButton').on("click",function(){
    table.on("click",'#editButton',function(e){
      e.preventDefault();
      $tr = $(this).closest('tr');
      if($($tr).hasClass('child')){
        $tr = $tr.prev('.parent');
      }
      
      var data = table.row($tr).data();
      
      $('#edit_needs').val(data[1]);
      $('#edit_quantity').val(data[2]);
      // $('#edit_outcome_date').val(data[3]);
      $('#edit_expense_balance').val(data[4]);
      $('#edit_outcome_type_id :selected').val(data[5]);
      $('#editForm').attr('action','/outcome/update/'+$("#editButton").data('id'));
      $('#editModal').modal('show');
    });
  // $('.data-outcome').DataTable({
  //   processing:true,
  //   serverSide:true,
  //   ajax:"{{route('outcome.index')}}",
  //   columns:[
  //     {data:"DT_RowIndex",name:"DT_RowIndex"},
  //     {data:"needs",name:"needs"},
  //     {data:"quantity",name:"quantity"},
  //     {data:"outcome_date",name:"outcome_date"},
  //     {data:"expense_balance",name:"expense_balance"},
  //     {data:"outcome_type",name:"outcome_type"},
  //     {data:"action",name:"action"},
  //     // {
  //     //   data:"id_inventory",
  //     //   render: function(data,type,row){
  //     //     return '<a href="/inventory/edit/'+data+'" class="btn btn-warning"><i class="fas fa-edit"></i></a> <a href="" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>';
  //     //   }
  //     // }
  //   ], 
  //     drawCallback: function(settings){
       
            
  //         });
  //     }

  $('#deleteButton').on("click",function(event){
    event.preventDefault();
    var url = $(this).attr('href');
    console.log(url);
    swal.fire({
      title: 'Apakah Kamu yakin ingin menghapus data ini ?',
      text: "Data yang terhapus tidak bisa di kembalikan!",
      icon: 'warning',
      // buttons: ["Cancel","Yakin!"],
      showCancelButton: true,
      // confirmButtonColor: '#3085d6',
      // cancelButtonColor: '#d33',
      confirmButtonText: 'Yakin !'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = url;
        }
    });
  });
  
});
</script>
@endpush