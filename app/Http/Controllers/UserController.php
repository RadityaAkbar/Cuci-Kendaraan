<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Pesanan;
use App\Models\Kategori;
use App\Models\Jeniscuci;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   
        $dates = now()->format('Ymd');
        $tanggal = now()->format('Y-m-d');
        $jumlah = Pesanan::whereDate('tgl_pesan', $tanggal)->count();
        $jumlah++;
        $no_pesan = 'C' . $dates . sprintf('%03d', $jumlah);

        $jamCuci = [
            '08:00','08:30',
            '09:00','09:30',
            '10:00','10:30',
            '11:00','11:30',
            '12:00','12:30',
            '13:00','13:30',
            '14:00','14:30',
            '15:00','15:30',
            '16:00','16:30',
            '17:00','17:30',
            '18:00','18:30',
            '19:00','19:30',
            '20:00',
        ];
        
          $jamSekarang = Carbon::now()->setTimezone('Asia/Jakarta')->format('H:i');
          $jamCuciTersedia = [];
          
          foreach ($jamCuci as $jam) {
              if ($jam >= $jamSekarang) {
                  $jamCuciTersedia[] = $jam;
              }
          }
          
        $kategori = Kategori::select('id', 'name')->get();
        $jeniscuci = Jeniscuci::select('id', 'name')->get();
        return view('user/index', ['jeniscuci' => $jeniscuci, 'kategori' => $kategori, 'no_pesan' => $no_pesan, 'tanggal' => $tanggal, 'jamCuciTersedia' => $jamCuciTersedia]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'tgl_pesan' => 'required|date',
            'jam_cuci' => 'required',
        ]);

        $tanggal = $validatedData['tgl_pesan'];
        $jam = $validatedData['jam_cuci'];

        // Cek apakah slot booking tersedia
        if (!Pesanan::available($tanggal, $jam)) {
            Session::flash('status', 'failed');
            Session::flash('message', 'Slot Cuci Penuh Pada Jam Tersebut');
            return redirect('/#pesan')->with('success', 'Gagal Melakukan Pemesanan');
        }

        $jeniscuci = $request->input('jeniscuci_id');
        $kategori = $request->input('kategori_id');
        $cuci = Jeniscuci::select('harga')->where('id', '=', $jeniscuci)->first()->harga;
        $kate = Kategori::select('harga')->where('id', '=', $kategori)->first()->harga;
        $hargatotal = $cuci + $kate;

        $request->merge(['harga_cuci' => $cuci]);
        $request->merge(['harga_kategori' => $kate]);
        $request->merge(['subtotal' => $hargatotal]);
        $request->merge(['user_id' => Auth::user()->id]);
        
        $pesanan = Pesanan::create($request->all());
        // $pesanan = new Pesanan();
        // $pesanan->tgl_pesan = now()->format('Y-m-d');
        // $pesanan->jam_cuci = $request->input('jam_cuci');
        // $pesanan->no_pesanan = $request->input('no_pesanan');
        // $pesanan->nama = $request->input('nama');
        // $pesanan->plat_nomor = $request->input('plat_nomor');    
        // $pesanan->jeniscuci_id = $request->input('jeniscuci_id');
        // $pesanan->kategori_id = $request->input('kategori_id');
        // $pesanan->harga_cuci = $cuci->harga;
        // $pesanan->harga_kategori = $kate->harga;
        // $pesanan->subtotal = $hargatotal;

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::  $isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        if($pesanan->metode_bayar == 'non-tunai') {
            $params = array(
                'transaction_details' => array(
                    'order_id' => $pesanan->no_pesanan,
                    'gross_amount' => $pesanan->subtotal,
                ),
                'customer_details' => array(
                    'name' => $request->nama,
                ),
            );
        } elseif($pesanan->metode_bayar == 'tunai') {
            $params = array(
                'transaction_details' => array(
                    'order_id' => $pesanan->no_pesanan,
                    'gross_amount' => $pesanan->harga_kategori,
                ),
                'customer_details' => array(
                    'name' => $request->nama,
                ),
            );
        }

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return view('user/konfirmasi', compact('snapToken'), ['pesanan' => $pesanan, 'cuci' => $cuci, 'kate' => $kate,]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        $pesanan = Pesanan::latest()->first();
        $pesanan->status_id = 2;
        $pesanan->update(); 
        return view('user/thank', ['pesanan' => $pesanan]);
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $pesanan = Pesanan::select()->with(['jeniscuci', 'kategori', 'status'])
        ->where('user_id', Auth::user()->id)
        ->where('status_id', '>', 1)
        ->paginate(5);
        return view('user/profil', ['pesanan' => $pesanan]);
    }

    public function detail($id)
    {
        $pesanan = Pesanan::with(['jeniscuci', 'kategori', 'status'])->findOrFail($id);
        return response()->json($pesanan);
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // Validasi data
        $this->validate($request, [
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users,email,' . auth()->user()->id],
            'nomor_hp' => ['required', 'string', 'min:10', 'max:15'],
        ]);
        
        // Update data user
        $user = auth()->user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->nomor_hp = $request->nomor_hp;
        $user->save();
        
        return redirect('/profil');
    }
    
    public function edit(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama yang Anda masukkan salah.']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect('profil')->with('success', 'Password Anda berhasil diubah.');
    }

    public function destroy($id)
    {
        $deletedPesanan = Pesanan::findOrFail($id);
        $deletedPesanan->delete();

        return redirect('/');
    }

    public function profil(Request $request)
    {
        $this->validate($request, [
            'image' => ['required'],
        ]);
        
        // Update data user
        $user = auth()->user();
        $user->image = $request->image;
        $user->save();
        
        return redirect('/profil');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function exportPdf(Request $request, $id)
    {
        $pesanan = Pesanan::select()->where('id', $id)->with(['jeniscuci', 'kategori', 'status', 'user'])->get();
        // dd($pesanan);
        $pdf = Pdf::loadView('pdf/export-pesanan', ['pesanan' => $pesanan]);
        return $pdf->download('invoice-'.Carbon::now()->timestamp.'.pdf');
    }

    // public function pdf(Request $request, $id)
    // {
    //     $pesanan = Pesanan::select()->where('id', $id)->with(['jeniscuci', 'kategori', 'status', 'user'])->get();
    //     return view('pdf/export-pesanan', ['pesanan' => $pesanan]);
    // }
}
