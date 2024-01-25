<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login() {
        return view('admin/login');
    }

    public function authenticate(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (Auth::user()->role_id == 1) {
                return redirect('/dashboard')->with('success', 'Berhasil Login Sebagai Admin');
            } else {
                return redirect('/')->with('success', 'Login Berhasil');
            }
              
        }

        Session::flash('status', 'failed');
        Session::flash('message', 'Wrong');
        return redirect('/login');
    }

    public function logout(Request $request)
    {   
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function register()
    {   
        return view('admin/register');
    }

    public function signin (Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = new User();
        $user->name = $request->input('name');
        $user->gender = $request->input('gender');
        $user->email = $request->input('email');
        $user->image = $request->input('image');
        $user->nomor_hp = $request->input('nomor_hp');
        $user->password = Hash::make($request->input('password'));

        $user->save();

        return redirect()->route('login')->with('success', 'Registrasi berhasil!');
    }
    
}
