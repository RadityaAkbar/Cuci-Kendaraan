<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::select()->where('role_id', '=', 2)->get();
        return view('admin/customer/customer', ['user' => $user]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $nomor = Image::count();
        $extension = $request->file('image')->getClientOriginalExtension();
        $newname = 'pp-'.$nomor.'-'.now()->timestamp.'.'.$extension;
        $request->file('image')->storeAs('photo', $newname);

        $pp['image'] = $newname;
        $pp = Image::create($request->all());
        $pp->update(['image' => $newname]);
        return redirect('/foto');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $customer = User::findOrFail($id);
        return view('admin/customer/customer-edit', ['customer' => $customer]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $deletedCustomer = User::findOrFail($id);
        $deletedCustomer->delete();

        // if($deletedCustomer) {
        //     Session::flash('status', 'success');
        //     Session::flash('message', 'Delete Success');
        // }

        return redirect('/customer');
    }
}
