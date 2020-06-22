<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lokasi;
use Yajra\Datatables\Datatables;

class LokasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        return view('lokasi.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newlokasi = new Lokasi;
        $newlokasi->nama        = $request->namalokasi;
        $newlokasi->keterangan  = $request->keteranganlokasi;
        $newlokasi->save();

        alert()->success('Berhasil.','Data telah disimpan!');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $lokasiupdate = Lokasi::find($id);
        $lokasiupdate->nama         = $request->namalokasi;
        $lokasiupdate->keterangan   = $request->keteranganlokasi;
        $lokasiupdate->save();

        alert()->error('Berhasil.','Data telah diupdate!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lokasidelete = Lokasi::find($id);
        $lokasidelete->delete();

        alert()->error('Berhasil.','Data telah didelete!');
        return back();
    }

    public function getdata()
    {
        $lokasi = Lokasi::get();
        
        return Datatables::of($lokasi)
        ->addColumn('action', function ($lokasi) {
            // $route = "{{ route(lokasi.update, ".$lokasi->id.") }}";
            return "
             <button data-toggle='modal' class='btn btn-info btn-sm' id='editlokasi' data-toggle='modal' data-target='#modal-lokasi'
                data-id='".$lokasi->id."'
                data-nama='".$lokasi->nama."'
                data-keterangan='".$lokasi->keterangan."'
             >Edit</button>

             <button data-toggle='modal' id='deletelokasi' class='btn btn-danger btn-sm' data-id='".$lokasi->id."'>
                Delete
             </button>";
        })
        ->editColumn('keterangan', function($lokasi) {
                if ($lokasi->keterangan == null or $lokasi->keterangan == "") {
                    return '-';
                }else{
                    return $lokasi->keterangan;
                }
        })
        ->rawColumns(['id', 'action'])
        ->addIndexColumn()
        ->make(true); 
    }
}
