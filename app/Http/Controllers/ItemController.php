<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Lokasi;
use App\Itemlokasi;
use App\Kategori;
use Yajra\Datatables\Datatables;

class ItemController extends Controller
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
        $kategori = Kategori::get();
        return view('item.index', compact('kategori'));
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

        $request->validate([
            'kodeitem' => 'required|unique:item,kode',
        ]);

        $itemstore = new Item;
        $itemstore->kode            = $request->kodeitem;
        $itemstore->nama            = $request->namaitem;
        $itemstore->kategori_id     = $request->kategoriitem;
        $itemstore->satuan          = $request->satuanitem;
        $itemstore->save();

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
        $dataitem   = Item::find($id);
        $kategori   = Kategori::get();
        $lokasi     = Lokasi::get();

        return view('item.edit', compact(['dataitem', 'kategori', 'lokasi']));
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
        $itemupdate = Item::find($id);
        $itemupdate->kode           = $request->kodeitemedit;
        $itemupdate->nama           = $request->namaitemedit;
        $itemupdate->kategori_id    = $request->kategoriitemedit;
        $itemupdate->satuan         = $request->satuanitemedit;
        $itemupdate->save();

        alert()->success('Berhasil.','Data Item telah di edit!');
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
        //
    }

    public function getdata()
    {
        $item = Item::get();

        return Datatables::of($item)
        ->addColumn('action', function ($item) {
            $url = '/item/'.$item->id.'/edit';
            return "
             <button data-toggle='modal' class='btn btn-info btn-sm' id='edititem'
                data-id='".$item->id."'
             >Edit</button>";
        })
        ->editColumn('kategori_id', function($item) {
            return $item->kategori->keterangan;
        })
        ->rawColumns(['id', 'action'])
        ->addIndexColumn()
        ->make(true); 
    }
}
