<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Itemlokasi;
use Yajra\Datatables\Datatables;

class ItemLokasiController extends Controller
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
        //
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
        $validate = Itemlokasi::where('lokasi_id', $request->lokasiitem)
                              ->where('item_id', $request->itemid)
                              ->get();

        if ($validate->count() > 0) {
            alert()->error('Perhatian.','Data sudah ada!');
            return back();
        }

        $itemlokasi = new Itemlokasi;
        $itemlokasi->item_id        = $request->itemid;
        $itemlokasi->lokasi_id      = $request->lokasiitem;
        $itemlokasi->diskon         = $request->diskonitem;
        $itemlokasi->hargabel       = $request->hargabelitem;
        $itemlokasi->hargajul       = $request->hargajualitem;
        $itemlokasi->status         = $request->statusitem;
        $itemlokasi->save();

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
        //
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

    public function getdata($iditem)
    {

        $itemlokasi = Itemlokasi::where('item_id', $iditem)->get();

        return Datatables::of($itemlokasi)
        ->addColumn('action', function ($itemlokasi) {
            return "
             <button data-toggle='modal' class='btn btn-info btn-sm' id='edititem'
                data-id='".$itemlokasi->id."'
             >Edit</button>";
        })
        ->editColumn('lokasi_id', function($itemlokasi) {
            return $itemlokasi->lokasi->nama;
        })
        ->editColumn('status', function($itemlokasi) {
            if ($itemlokasi->status == 1) {
                return 'Aktif';
            }else{
                return 'Tidak Aktif';
            }
        })
        ->rawColumns(['id', 'action'])
        ->addIndexColumn()
        ->make(true); 
    }
}
