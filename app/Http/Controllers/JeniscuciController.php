<?php

namespace App\Http\Controllers;

use App\Models\Jeniscuci;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class JeniscuciController extends Controller
{
    public function index(){
        $jeniscuci = Jeniscuci::all();
        return view('admin/jenis_cuci/jenis-cuci', ['jeniscuci' => $jeniscuci]);
    }

    public function create(){
        return view('admin/jenis_cuci/jeniscuci-add');
    }

    public function store(Request $request)
    {
        $jeniscuci = Jeniscuci::create($request->all());
        return redirect('/jeniscuci');
    }

    public function edit(Request $request, $id)
    {
        $jeniscuci = Jeniscuci::findOrFail($id);
        return view('admin/jenis_cuci/jeniscuci-edit', ['jeniscuci' => $jeniscuci]);
    }

    public function update(Request $request, $id)
    {
        $jeniscuci = Jeniscuci::findOrFail($id);
        $jeniscuci->update($request->all());
        return redirect('/jeniscuci');
    }

    public function destroy($id)
    {
        $deletedJeniscuci = Jeniscuci::findOrFail($id);
        $deletedJeniscuci->delete();

        if($deletedJeniscuci) {
            Session::flash('status', 'success');
            Session::flash('message', 'Delete Success');
        }

        return redirect('/jeniscuci');
    }
}
