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
        $no_pesan = 'C';
        if($jumlah > 99) {
            $no_pesan = 'C'.$dates.$jumlah;
        } else if($jumlah > 9) {
            $no_pesan = 'C'.$dates.'0'.$jumlah;
        } else {
            $no_pesan = 'C'.$dates.'00'.$jumlah;
        }

        $jamCuci = [
            '08.00','08.30',
            '09.00','09.30',
            '10.00','10.30',
            '11.00','11.30',
            '12.00','12.30',
            '13.00','13.30',
            '14.00','14.30',
            '15.00','15.30',
            '16.00','16.30',
            '17.00','17.30',
            '18.00','18.30',
            '19.00','19.30',
            '20.00',
          ];
        $jamCuciTerpilih = $request->old('jam_cuci');

        $kategori = Kategori::select('id', 'name')->get();
        $jeniscuci = Jeniscuci::select('id', 'name')->get();
        return view('user/index', ['jeniscuci' => $jeniscuci, 'kategori' => $kategori, 'no_pesan' => $no_pesan, 'tanggal' => $tanggal, 'jamCuci' => $jamCuci, 'jamCuciTerpilih' => $jamCuciTerpilih]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $jeniscuci = $request->input('jeniscuci_id');
        $kategori = $request->input('kategori_id');
        $cuci = Jeniscuci::select('name', 'harga')->where('id', '=', $jeniscuci)->first();
        $kate = Kategori::select('name', 'harga')->where('id', '=', $kategori)->first();
        $hargatotal = $cuci->harga + $kate->harga;

        $pesanan = new Pesanan();
        $pesanan->tgl_pesan = now()->format('Y-m-d');
        $pesanan->jam_cuci = $request->input('jam_cuci');
        $pesanan->no_pesanan = $request->input('no_pesanan');
        $pesanan->nama = $request->input('nama');
        $pesanan->plat_nomor = $request->input('plat_nomor');
        $pesanan->jeniscuci_id = $request->input('jeniscuci_id');
        $pesanan->kategori_id = $request->input('kategori_id');
        $pesanan->harga_cuci = $cuci->harga;
        $pesanan->harga_kategori = $kate->harga;
        $pesanan->subtotal = $hargatotal;

        return view('user/konfirmasi', ['pesanan' => $pesanan, 'cuci' => $cuci, 'kate' => $kate]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        $request->merge(['user_id' => Auth::user()->id]);
        $pesanan = Pesanan::create($request->all());    
         return redirect('/#pesan');   
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $user = User::where('id', Auth::user()->id);
        $pesanan = Pesanan::select()->with(['jeniscuci', 'kategori', 'status'])->where('user_id', Auth::user()->id)->get();
        return view('user/profil', ['user' => $user, 'pesanan' => $pesanan]);
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
        
        return view('user/profil');
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
        $pesanan = Pesanan::select()->where('id', $id)->with(['jeniscuci', 'kategori', 'status'])->get();
        // dd($pesanan);
        $pdf = Pdf::loadView('pdf/export-pesanan', ['pesanan' => $pesanan]);
        return $pdf->download('invoice-'.Carbon::now()->timestamp.'.pdf');
    }
}
