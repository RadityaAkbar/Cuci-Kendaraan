<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    {   
        $pesanan = Pesanan::count();
        return view('admin/dashboard', ['pesanan' => $pesanan]);
    }
}
