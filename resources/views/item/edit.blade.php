@extends('layouts.admin')
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('#item-lokasi-table').DataTable({
        destroy: true,
        processing: true,
        serverSide: true,
        method : 'GET',
        ajax: '{{URL::to("/itemlokasi/getdata/".$dataitem->id)}}',
        columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
        {data: 'lokasi_id', name: 'lokasi_id'},
        {data: 'diskon', name: 'diskon'},
        {data: 'hargabel', name: 'hargabel'},
        {data: 'hargajul', name: 'hargajul'},
        {data: 'status', name: 'status'},
        {data: 'action', name: 'action',orderable: false, searchable: false }
        ],
        columnDefs: [
            {
                "targets": 6, // your case first column
                "className": "text-center"
            },
        ]
    }); 
} );

$(document).on('click', '#edititem', function(){   
    $('#lokasiitemedit').val($(this).data('lokasi'));
    $('#diskonitemedit').val($(this).data('diskon'));
    $('#hargabelitemedit').val($(this).data('hargabel'));
    $('#hargajualitemedit').val($(this).data('hargajul'));
    $('#statusitemedit').val($(this).data('status'));
    $('#formmodalitemedit').attr('action', '/itemlokasi/'+$(this).data('id') );
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
                    <h3 class="card-title">Edit Lokasi</h3>
                </div>
                <form action="{{ route('item.update', $dataitem->id) }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('put') }}
                    <div class="card-body">
                        <div class="form-group">
                            <label>Kode :</label>
                            <div class="input-group">
                                <input type="text" id="kodeitemedit" name="kodeitemedit" value="{{ $dataitem->kode }}" class="form-control" autocomplete="off" maxlength="12" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Nama :</label>
                            <div class="input-group">
                                <input type="text" id="namaitemedit" name="namaitemedit" value="{{ $dataitem->nama }}" class="form-control" autocomplete="off" maxlength="20" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Kategori :</label>
                            <div class="input-group">
                                <select type="text" id="kategoriitemedit" name="kategoriitemedit" class="form-control">
                                    @foreach($kategori as $value)
                                        @if($dataitem->kategori_id == $value->id )
                                            <option value="{{ $value->id }}" selected>{{ $value->keterangan }}</option>
                                        @else
                                            <option value="{{ $value->id }}">{{ $value->keterangan }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Satuan :</label>
                            <div class="input-group">
                                <input type="text" id="satuanitemedit" name="satuanitemedit" value="{{ $dataitem->satuan }}" class="form-control" autocomplete="off" maxlength="3" required>
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
                <div class="card-header">Data Item Lokasi</div>
                <div class="card-body">
                    <button class="btn btn-danger btn-sm text-white float-right" data-toggle='modal' data-target='#modal-lokasi-item'>Tambah Item lokasi</button>
                    <div class="card-block">
                        <div class="table-responsive pt-2">
                            <table id="item-lokasi-table" class="table table-sm table-striped table-bordered nowrap">
                                <thead>
                                    <tr>
                                        <th style="max-width: 30px;">
                                            No
                                        </th>
                                        <th>
                                            Lokasi
                                        </th>
                                        <th>
                                            Diskon%
                                        </th>
                                        <th>
                                            Harga Beli
                                        </th>
                                        <th>
                                            Harga Jual
                                        </th>
                                        <th>
                                            Status
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
                                            Lokasi
                                        </th>
                                        <th>
                                            Diskon%
                                        </th>
                                        <th>
                                            Harga Beli
                                        </th>
                                        <th>
                                            Harga Jual
                                        </th>
                                        <th>
                                            Status
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

<div class="modal fade" id="modal-lokasi-item">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Item Lokasi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('itemlokasi.store') }}" id="formmodalitem" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                    {{ csrf_field() }}
                    <div class="card-body">
                        <input type="hidden" name="itemid" value="{{ $dataitem->id }}">
                        <div class="form-group">
                            <label>Lokasi :</label>
                            <div class="input-group">
                                <select id="lokasiitem" name="lokasiitem" class="form-control">
                                    @foreach($lokasi as $value)
                                        <option value="{{ $value->id }}">{{ $value->keterangan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Diskon :</label>
                            <div class="input-group">
                                <input type="text" id="diskonitem" name="diskonitem" class="form-control text-right" autocomplete required/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Harga Beli :</label>
                            <div class="input-group">
                                <input type="text" id="hargabelitem" name="hargabelitem" class="form-control text-right" autocomplete required/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Harga Jual :</label>
                            <div class="input-group">
                                <input type="text" id="hargajualitem" name="hargajualitem" class="form-control text-right" autocomplete required/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Status :</label>
                            <div class="input-group">
                                <select id="statusitem" name="statusitem" class="form-control">
                                    <option value="1">Aktif</option>
                                    <option value="0">Tidak Aktif</option>
                                </select>
                            </div>
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

<div class="modal fade" id="modal-lokasi-item-edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Item Lokasi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('itemlokasi.store') }}" id="formmodalitemedit" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                    {{ csrf_field() }}
                    {{ method_field('put') }}
                    <div class="card-body">
                        <input type="hidden" name="itemid" value="{{ $dataitem->id }}">
                        <div class="form-group">
                            <label>Lokasi :</label>
                            <div class="input-group">
                                <select id="lokasiitemedit" name="lokasiitem" class="form-control">
                                    @foreach($lokasi as $value)
                                        <option value="{{ $value->id }}">{{ $value->keterangan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Diskon :</label>
                            <div class="input-group">
                                <input type="text" id="diskonitemedit" name="diskonitem" class="form-control text-right" autocomplete required/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Harga Beli :</label>
                            <div class="input-group">
                                <input type="text" id="hargabelitemedit" name="hargabelitem" class="form-control text-right" autocomplete required/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Harga Jual :</label>
                            <div class="input-group">
                                <input type="text" id="hargajualitemedit" name="hargajualitem" class="form-control text-right" autocomplete required/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Status :</label>
                            <div class="input-group">
                                <select id="statusitemedit" name="statusitem" class="form-control">
                                    <option value="1">Aktif</option>
                                    <option value="0">Tidak Aktif</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="modal-footer justify-content">
                    <button type="submit" name="btnsubmit" value="del" class="btn btn-danger ">Delete</button>
                    <button type="submit" name="btnsubmit" value="sav" class="btn btn-primary ">Save changes</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@endsection