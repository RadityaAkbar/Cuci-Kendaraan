<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use App\Exports\PesananExport;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    {   
        $pesanan = Pesanan::count();
        $user = User::select()->where('role_id', 2)->count();
        return view('admin/dashboard', ['pesanan' => $pesanan, 'user' => $user]);
    }

    public function show(Request $request)
    {   
        $start = Carbon::parse($request->tgl_awal);
        $end = Carbon::parse($request->tgl_akhir);
        $dates = [$start, $end];

        $pesanan = Pesanan::with(['kategori', 'jeniscuci', 'status'])
            ->whereBetween('tgl_pesan', $dates)
            ->get();

        session()->put('dates', $dates);
        return view('admin/laporan', ['pesanan' => $pesanan]);
    }

    public function export()
    {
        $dates = session()->get('dates');

        return (new PesananExport($dates))->download('pesanan-'.Carbon::now()->timestamp.'.xlsx');
    }
}
