@extends('layouts.admin')
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('#members-table').DataTable({
        destroy: true,
        processing: true,
        serverSide: true,
        method : 'GET',
        ajax: '{{URL::to("/kategori/getdata")}}',
        columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
        {data: 'keterangan', name: 'keterangan'},
        {data: 'action', name: 'action',orderable: false, searchable: false }
        ],
        columnDefs: [
          {
              "targets": 2, // your case first column
              "className": "text-center"
         }]
    }); 
} );

$(document).on('click', '#editkategori', function(){   
    $('#namakategoriedit').val($(this).data('nama'));
    $('#keterangankategoriedit').val($(this).data('keterangan'));
    $('#kategoriformedit').attr('action', '/kategori/'+$(this).data('id') );
});

$(document).on('click', '#deletekategori', function(){   
    $('#kategoriformdelete').attr('action', '/kategori/'+$(this).data('id') );
    $('#kategoriformdelete').submit();
});
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
                    <h3 class="card-title">Tambah kategori</h3>
                </div>
                <form action="{{ route('kategori.store') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="card-body">
                        <div class="form-group">
                        <label>Keterangan:</label>
                            <div class="input-group">
                                <textarea id="keterangankategori" name="keterangankategori" class="form-control" maxlength="50"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
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
                            <table id="members-table" class="table table-sm table-striped table-bordered nowrap">
                                <thead>
                                    <tr>
                                        <th style="max-width: 30px;">
                                            No
                                        </th>
                                        <th>
                                            Keterangan
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
                                            Keterangan
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

<div class="modal fade" id="modal-kategori">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit kategori</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('kategori.store') }}" id="kategoriformedit" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    {{ csrf_field() }}
                    {{ method_field('put') }}
                    <div class="card-body">
                        <div class="form-group">
                        <label>Keterangan:</label>
                            <div class="input-group">
                                <textarea id="keterangankategoriedit" name="keterangankategori" class="form-control" maxlength="50"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content">
                    <button type="submit" class="btn btn-primary ">Save changes</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@endsection