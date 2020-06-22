@extends('layouts.admin')
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('#items-table').DataTable({
        destroy: true,
        processing: true,
        serverSide: true,
        method : 'GET',
        ajax: '{{URL::to("/item/getdata")}}',
        columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
        {data: 'kode', name: 'kode'},
        {data: 'nama', name: 'nama'},
        {data: 'kategori_id', name: 'kategori_id'},
        {data: 'satuan', name: 'satuan'},
        {data: 'action', name: 'action',orderable: false, searchable: false }
        ],
        columnDefs: [
          {
              "targets": 5, // your case first column
              "className": "text-center"
         }]
    }); 
} );

$(document).on('click', '#edititem', function(){   
    window.location = '/item/'+$(this).data('id')+'/edit';
});
</script>

@section('content')

<div class="col-lg-12">
    @if ($errors->any())
        <div class="alert alert-danger" id="waktu2">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

  @if (Session::has('message'))
    <div class="alert alert-{{ Session::get('message_type') }}" id="waktu2" style="margin-top:10px;">{{ Session::get('message') }}</div>
  @endif
</div>

<div class="pt-1">
    <div class="row">
        <div class="col-md-3">
            <div class="card card-danger">
                <div class="card-header">
                    <h3 class="card-title">Tambah Item</h3>
                </div>
                <form action="{{ route('item.store') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="card-body">
                        <div class="form-group">
                            <label>Kode :</label>
                            <div class="input-group">
                                <input type="text" id="kodeitem" name="kodeitem" class="form-control" autocomplete="off" maxlength="12" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Nama :</label>
                            <div class="input-group">
                                <input type="text" id="namaitem" name="namaitem" class="form-control" autocomplete="off" maxlength="20" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Kategori :</label>
                            <div class="input-group">
                                <select type="text" id="kategoriitem" name="kategoriitem" class="form-control">
                                    @foreach($kategori as $value)
                                        <option value="{{ $value->id }}">{{ $value->keterangan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Satuan :</label>
                            <div class="input-group">
                                <input type="text" id="satuanitem" name="satuanitem" class="form-control" autocomplete="off" maxlength="3" required>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-9">
            <div class="card card-primary">
                <div class="card-header">Data Item</div>
                <div class="card-body">
                    <div class="card-block">
                        <div class="table-responsive">
                            <table id="items-table" class="table table-sm table-striped table-bordered nowrap">
                                <thead>
                                    <tr>
                                        <th style="max-width: 30px;">
                                            No
                                        </th>
                                        <th>
                                            Kode
                                        </th>
                                        <th>
                                            Nama
                                        </th>
                                        <th>
                                            Kategori
                                        </th>
                                        <th>
                                            Satuan
                                        </th>
                                        <th>
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th style="max-width: 30px;">
                                            No
                                        </th>
                                        <th>
                                            Kode
                                        </th>
                                        <th>
                                            Nama
                                        </th>
                                        <th>
                                            Kategori
                                        </th>
                                        <th>
                                            Satuan
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
@endsection