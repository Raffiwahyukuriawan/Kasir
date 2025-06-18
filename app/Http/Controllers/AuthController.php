<?php

namespace App\Http\Controllers;

use App\Models\ProfilToko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController
{
    public function auth()
    {
        $konfigurasi = ProfilToko::find(100);
        return view('auth',[
            'konfigurasi' => $konfigurasi
        ]);
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
    
        if (Auth::attempt($data)) {
            $request->session()->regenerate();
            $user = Auth::user();
    
            // Simpan nama user ke session
            $request->session()->put('nama', $user->nama);
    
            if ($user->role == 'admin') {
                return redirect('/');
            } elseif ($user->role == 'kasir') {
                return redirect('/dashboard_kasir');
            } elseif ($user->role == 'manager') {
                return redirect('/dashboard/manager');
            }
        }
    
        return back()->withErrors(['email' => 'Email atau Password anda salah']);
    }
    
    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
