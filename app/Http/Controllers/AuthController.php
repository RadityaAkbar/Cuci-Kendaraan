<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\ForgotPasswordMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login() {
        return view('auth/login');
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
        Session::flash('message', 'Email atau Password Salah');
        return redirect('/login');
    }

    public function logout(Request $request)
    {   
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Anda Telah Logout');
    }

    public function register()
    {   
        return view('auth/register');
    }

    public function signin (Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'nomor_hp' => 'required|numeric|min:11|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->image = $request->input('image');
        $user->nomor_hp = $request->input('nomor_hp');
        $user->password = Hash::make($request->input('password'));

        $user->save();

        return redirect()->route('login')->with('success', 'Registrasi berhasil!');
    }

    public function forgot()
    {
        return view('auth/forgot');
    }
    
    public function forgot_password(Request $request)
    {
        $user = User::where('email', '=', $request->email)->first();
        if (!empty($user)) {
            $user->remember_token = Str::random(40);
            $user->save();

            Mail::to($user->email)->send(new ForgotPasswordMail($user));
            return redirect('/forgot')->with('success', 'Silahkan cek email anda!');
        } else {
            return redirect('/forgot')->with('error', 'Email tidak ditemukan!');
        }
    }

    public function reset($token)
    {
        $user = User::where('remember_token', '=', $token)->first();
        if (!empty($user)) {
            $data['user'] = $user;
            return view('auth.reset', $data);
        } else {
            return redirect('login');
        }
    }

    public function post_reset($token, Request $request)
    {
        $user = User::where('remember_token', '=', $token)->first();
        if (!empty($user)) {
            if ($request->password == $request->cpassword) {
                $user->password = Hash::make($request->password);
                if(empty($user->email_verified_at)) {
                    $user->email_verified_at = date('Y-m-d H:i:s');
                }
                $user->remember_token = Str::random(40);
                $user->save();
                return redirect()->back()->with('success', 'Password berhasil diperbarui');
            } else {
                return redirect()->back()->with('error', 'Password tidak sama!');
            }
        } else {
            abort(404);
        }
    }
}
