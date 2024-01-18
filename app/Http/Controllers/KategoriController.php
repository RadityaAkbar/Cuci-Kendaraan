<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class KategoriController extends Controller
{
    public function index()
    {   
        $kategori = Kategori::all();
        return view('admin/kategori/kategori', ['kategori' => $kategori]);
    }

    public function create()
    {
        return view('admin/kategori/kategori-add');
    }

    public function store(Request $request)
    {
        $kategori = Kategori::create($request->all());
        return redirect('kategori');
    }

    public function edit(Request $request, $id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('admin/kategori/kategori-edit', ['kategori' => $kategori]);
    }

    public function update(Request $request, $id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->update($request->all());
        return redirect('kategori');
    }

    public function destroy($id)
    {
        $deletedKategori = Kategori::findOrFail($id);
        $deletedKategori->delete();

        if($deletedKategori) {
            Session::flash('status', 'success');
            Session::flash('message', 'Delete Success');
        }

        return redirect('kategori');
    }
}
