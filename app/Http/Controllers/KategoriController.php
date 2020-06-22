<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kategori;
use Yajra\Datatables\Datatables;

class KategoriController extends Controller
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
        return view('kategori.index');
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
        $kategori = new Kategori;
        $kategori->keterangan = $request->keterangankategori;
        $kategori->save();

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
        $kategoriupdate = Kategori::find($id);
        $kategoriupdate->keterangan   = $request->keterangankategori;
        $kategoriupdate->save();

        alert()->success('Berhasil.','Data telah diupdate!');
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
        $kategoridelete = Kategori::find($id);
        $kategoridelete->delete();

        alert()->success('Berhasil.','Data telah didelete!');
        return back();
    }

    public function getdata()
    {
        $kategori = Kategori::get();
        
        return Datatables::of($kategori)
        ->addColumn('action', function ($kategori) {
            // $route = "{{ route(lokasi.update, ".$lokasi->id.") }}";
            return "
             <button data-toggle='modal' class='btn btn-info btn-sm' id='editkategori' data-toggle='modal' data-target='#modal-kategori'
                data-id='".$kategori->id."'
                data-keterangan='".$kategori->keterangan."'
             >Edit</button>

             <button data-toggle='modal' id='deletekategori' class='btn btn-danger btn-sm' data-id='".$kategori->id."'>
                Delete
             </button>";
        })
        ->editColumn('keterangan', function($kategori) {
                if ($kategori->keterangan == null or $kategori->keterangan == "") {
                    return '-';
                }else{
                    return $kategori->keterangan;
                }
        })
        ->rawColumns(['id', 'action'])
        ->addIndexColumn()
        ->make(true); 
    }
}
