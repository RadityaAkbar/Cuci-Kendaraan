<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Status;
use App\Models\Pesanan;
use App\Models\Kategori;
use App\Models\Jeniscuci;
use Illuminate\Http\Request;
use App\Exports\PesananExport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $pesanan = Pesanan::with(['kategori', 'jeniscuci', 'status'])
                    ->where('nama', 'LIKE', '%'.$keyword.'%')
                    ->orWhere('plat_nomor', 'LIKE', '%'.$keyword.'%')
                    ->paginate(6);
        return view('admin/pesanan/pesanan', ['pesanan' => $pesanan]);
    }

    public function show($id)
    {
        $pesanan = Pesanan::with(['jeniscuci', 'kategori', 'status'])->findOrFail($id);
        return response()->json($pesanan);
    }

    public function create()
    {   
        $dates = now()->format('Ymd');
        $tanggal = now()->format('Y-m-d');
        $jumlah = Pesanan::whereDate('tgl_pesan', $tanggal)->count();
        $jumlah++;
        $no_pesan = 'C';
        if($jumlah > 99) {
            $no_pesan = 'C'.$dates.$jumlah;
        } else if($jumlah > 9) {
            $no_pesan = 'C'.$dates.'0'.$jumlah;
        } else {
            $no_pesan = 'C'.$dates.'00'.$jumlah;
        }
        $kategori = Kategori::select('id', 'name')->get();
        $jeniscuci = Jeniscuci::select('id', 'name')->get();
        return view('admin/pesanan/pesanan-add', ['jeniscuci' => $jeniscuci, 'kategori' => $kategori, 'no_pesan' => $no_pesan, 'tanggal' => $tanggal]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        $jeniscuci = $request->input('jeniscuci_id');
        $kategori = $request->input('kategori_id');
        $cuciharga = Jeniscuci::select('harga')->where('id', '=', $jeniscuci)->first()->harga;
        $kategoriharga = Kategori::select('harga')->where('id', '=', $kategori)->first()->harga;
        $hargatotal = $cuciharga + $kategoriharga;

        $request->merge(['harga_cuci' => $cuciharga]);
        $request->merge(['harga_kategori' => $kategoriharga]);
        $request->merge(['subtotal' => $hargatotal]);
        $request->merge(['tgl_pesan' => now()]);
        $request->merge(['user_id' => Auth::user()->id]);
        $pesanan = Pesanan::create($request->all());    
         return redirect('/pesanan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        $pesanan = Pesanan::with(['jeniscuci', 'kategori', 'status'])->findOrFail($id);
        $status = Status::where('id', '!=', $pesanan->status_id)->get(['id', 'name']);
        return view('admin/pesanan/pesanan-edit', ['pesanan' => $pesanan, 'status' => $status]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->update($request->all());
        return redirect('pesanan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $deletedPesanan = Pesanan::findOrFail($id);
        $deletedPesanan->delete();

        if($deletedPesanan) {
            Session::flash('status', 'success');
            Session::flash('message', 'Delete Success');
        }

        return redirect('/pesanan');
    }

    public function export()
    {
        return (new PesananExport)->download('pesanan-'.Carbon::now()->timestamp.'.xlsx');
    }
}
