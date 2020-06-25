<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\User;
use Yajra\Datatables\Datatables;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::get();
        // return $user;
        return view('customer.index', compact('user'));
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
        $customer = new Customer;
        $customer->nama     = $request->customernama;
        $customer->alamat   = $request->customeralamat;
        $customer->telp     = $request->customertelp;
        $customer->user_id  = $request->customeruserid;
        $customer->save();
        
        alert()->success('Berhasil.','Data telah ditambahkan!');
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
        $customer           = Customer::find($id);
        $customer->nama     = $request->customernamaedit;
        $customer->telp     = $request->customertelpedit;
        $customer->alamat   = $request->customeralamatedit;
        $customer->user_id  = $request->customeruseridedit;
        $customer->save();

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
        $customer = Customer::find($id);
        $customer->delete();

        return back();
    }

    public function getdata()
    {
        $customer = Customer::get();
        
        // return $customer->user;

        return Datatables::of($customer)
        ->addColumn('action', function ($customer) {
            // $route = "{{ route(lokasi.update, ".$lokasi->id.") }}";
            return "
             <button data-toggle='modal' class='btn btn-info btn-sm' id='editcustomer' data-target='#modal-customer'
                data-id='".$customer->id."'
                data-nama='".$customer->nama."'
                data-alamat='".$customer->alamat."'
                data-telp='".$customer->telp."'
                data-user='".$customer->user->name."'
                data-userid='".$customer->user_id."'
             >Edit</button>
             
             <button data-toggle='modal' id='deletecustomer' class='btn btn-danger btn-sm' data-target='#modal-sm'
                data-id='".$customer->id."' 
                data-nama='".$customer->nama."'>
                Delete
             </button>";
        })
        ->editColumn('user_id', function($customer) {
                // if ($kategori->keterangan == null or $kategori->keterangan == "") {
                //     return '-';
                // }else{
                    return $customer->user->name;
                // }
        })
        ->rawColumns(['id', 'action'])
        ->addIndexColumn()
        ->make(true); 
    }
}
