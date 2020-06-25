@extends('layouts.admin')
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('#customer-table').DataTable({
        destroy: true,
        processing: true,
        serverSide: true,
        method : 'GET',
        ajax: '{{URL::to("/customer/getdata")}}',
        columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
        {data: 'nama', name: 'nama'},
        {data: 'telp', name: 'telp'},
        {data: 'alamat', name: 'alamat'},
        {data: 'user_id', name: 'user_id'},
        {data: 'action', name: 'action',orderable: false, searchable: false }
        ],
        columnDefs: [
        {
              "targets": 2, // your case first column
              "className": "text-right"
        },{
              "targets": 5, // your case first column
              "className": "text-center"
        }
        ]
    }); 
} );

$(document).on('click', '#editcustomer', function(){   
    $('#customeruseredit').val($(this).data('user'));
    $('#customeruseridedit').val($(this).data('userid'));
    $('#customernamaedit').val($(this).data('nama'));
    $('#customeralamatedit').val($(this).data('alamat'));
    $('#customertelpedit').val($(this).data('telp'));
    $('#customerformedit').attr('action', '/customer/'+$(this).data('id') );
});

$(document).on('click', '#deletecustomer', function(){   
    $('#titlemodalsm').html($(this).data('nama'));
    $('#customerformdelete').attr('action', '/customer/'+$(this).data('id') );
});

$(document).on('change', '#customeruser', function(){   
    var val     = $("#customeruser").val();
    var obj     = $("#customeruserdatalist").find("option[value='"+val+"']")
    var endval  = obj.attr('id');

    if(obj !=null && obj.length>0){
        $('#customeruserid').val(endval);
    }else{
        $('#customeruserid').val('');
    }
});

$(document).on('change', '#customeruseredit', function(){   
    var val     = $("#customeruseredit").val();
    var obj     = $("#customeruserdatalistedit").find("option[value='"+val+"']")
    var endval  = obj.attr('id');

    if(obj !=null && obj.length>0){
        $('#customeruseridedit').val(endval);
    }else{
        $('#customeruseridedit').val('');
    }
});

$(document).on('click', '#sbmtforminputcustomer', function(){
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

    var customerusrid = $('#customeruserid').val();
    if (customerusrid == '' || customerusrid == null) {
        Toast.fire({
            type: 'error',
            title: 'User tidak tersedia'
        })
        return false;
    }
});

$(document).on('click', '#sbmtforminputcustomeredit', function(){
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

    var customerusrid = $('#customeruseridedit').val();
    if (customerusrid == '' || customerusrid == null) {
        Toast.fire({
            type: 'error',
            title: 'User tidak tersedia'
        })
        return false;
    }
});

const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger'
  },
  buttonsStyling: false
})
</script>

@section('content')

<div class="col-lg-12">
  @if (Session::has('message'))
    <div class="alert alert-{{ Session::get('message_type') }}" id="waktu2" style="margin-top:10px;">{{ Session::get('message') }}</div>
  @endif
</div>

<div class="pt-1">
    <div class="row">
        <div class="col-md-3">
            <div class="card card-danger">
                <div class="card-header">
                    <h3 class="card-title">Tambah Customer</h3>
                </div>
                <form action="{{ route('customer.store') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="card-body">
                        <div class="form-group">
                        <label>Nama :</label>
                            <div class="input-group">
                                <input type="text" name="customernama" id="customernama" class="form-control" maxlength="20" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Telp :</label>
                                <div class="input-group">
                                    <input type="text" name="customertelp" id="customertelp" class="form-control text-right" maxlength="20" required>
                                </div>
                        </div>
                        <div class="form-group">
                            <label>Alamat :</label>
                                <div class="input-group">
                                    <textarea type="text" name="customeralamat" id="customeralamat" class="form-control" maxlength="50" required></textarea>
                                </div>
                        </div>
                        <div class="form-group">
                            <label>User :</label>
                                <div class="input-group">
                                    <input type="text" name="customeruser" id="customeruser" class="form-control" autocomplete="off" list="customeruserdatalist">
                                    <datalist id="customeruserdatalist">
                                        @foreach ($user as $data)
                                            <option id="{{ $data->id }}" value="{{ $data->name }}" >{{ $data->name }}</option>
                                        @endforeach
                                    </datalist>
                                    <input type="hidden" name="customeruserid" id="customeruserid" required>
                                </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" id="sbmtforminputcustomer">Submit</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">Data kategori</div>
                <div class="card-body">
                    <div class="card-block">
                        <div class="table-responsive">
                            <table id="customer-table" class="table table-sm table-striped table-bordered nowrap">
                                <thead>
                                    <tr>
                                        <th style="max-width: 20px;">
                                            No
                                        </th>
                                        <th>
                                            Nama
                                        </th>
                                        <th>
                                            Telp
                                        </th>
                                        <th>
                                            Alamat
                                        </th>
                                        <th>
                                            User
                                        </th>
                                        <th>
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th style="max-width: 20px;">
                                            No
                                        </th>
                                        <th>
                                            Nama
                                        </th>
                                        <th>
                                            Telp
                                        </th>
                                        <th>
                                            Alamat
                                        </th>
                                        <th>
                                            User
                                        </th>
                                        <th>
                                            Action
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<form method="post" action="" id="kategoriformdelete">
    {{ csrf_field() }}
    {{ method_field('delete') }}
</form>

<div class="modal fade" id="modal-customer">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Customer</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('customer.store') }}" id="customerformedit" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    {{ csrf_field() }}
                    {{ method_field('put') }}
                    <div class="form-group">
                        <label>Nama :</label>
                            <div class="input-group">
                                <input type="text" name="customernamaedit" id="customernamaedit" class="form-control" maxlength="20" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Telp :</label>
                                <div class="input-group">
                                    <input type="text" name="customertelpedit" id="customertelpedit" class="form-control text-right" maxlength="20" required>
                                </div>
                        </div>
                        <div class="form-group">
                            <label>Alamat :</label>
                                <div class="input-group">
                                    <textarea type="text" name="customeralamatedit" id="customeralamatedit" class="form-control" maxlength="50" required></textarea>
                                </div>
                        </div>
                        <div class="form-group">
                            <label>User :</label>
                                <div class="input-group">
                                    <input type="text" name="customeruseredit" id="customeruseredit" class="form-control" autocomplete="off" list="customeruserdatalistedit">
                                    <datalist id="customeruserdatalistedit">
                                        @foreach ($user as $data)
                                            <option id="{{ $data->id }}" value="{{ $data->name }}" >{{ $data->name }}</option>
                                        @endforeach
                                    </datalist>
                                    <input type="hidden" name="customeruseridedit" id="customeruseridedit" required>
                                </div>
                        </div>
                </div>
                <div class="modal-footer justify-content">
                    <button type="submit" class="btn btn-primary" id="sbmtforminputcustomeredit">Save changes</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="modal-sm">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="titlemodalsm">Small Modal</h4>
            </div>
            <div class="modal-body">
                <p>Hapus data ini?</p>
                <form action="" id="customerformdelete" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('delete') }}
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="$('#customerformdelete').submit();">Delete</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
  <!-- /.modal -->

<script>
$("#customertelp").keypress(function(e){
  if (e.which != 46 && e.which != 45 && e.which != 46 &&
      !(e.which >= 48 && e.which <= 57)) {
    return false;
  }
});

$("#customertelpedit").keypress(function(e){
  if (e.which != 46 && e.which != 45 && e.which != 46 &&
      !(e.which >= 48 && e.which <= 57)) {
    return false;
  }
});
</script>
@endsection