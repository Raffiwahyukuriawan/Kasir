<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\ProfilToko;
use Illuminate\Support\Facades\Storage;

class KonfigurasiController
{
    public function index()
    {
        $konfigurasi = ProfilToko::find(100);
        return view('konfigurasi', [
            'title' => 'Konfigurasi',
            'konfigurasi' => $konfigurasi,
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'nama_toko' => 'required|string',
                'alamat' => 'required|string',
                'no_telp' => 'required|regex:/^[0-9]{10,15}$/',
                'email' => 'required|email',
                'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'jam_operasional' => 'required|string',
                'instagram' => 'required|string',
                'facebook' => 'required|string',
            ]);
    
            $profil = ProfilToko::findOrFail($id);
    
            if ($request->hasFile('logo')) {
                $file = $request->file('logo');
    
                if ($file->isValid()) {
                    // Hapus logo lama jika ada
                    $oldLogo = public_path('assets/logo/' . $profil->logo);
                    if ($profil->logo && file_exists($oldLogo)) {
                        unlink($oldLogo);
                    }
    
                    // Simpan logo baru di public/assets/logo/
                    $filename = time() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('assets/logo'), $filename);
    
                    $profil->logo = $filename;
                }
            }
    
            $profil->update([
                'nama_toko' => $request->nama_toko,
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp,
                'email' => $request->email,
                'logo' => $profil->logo ?? $profil->getOriginal('logo'),
                'jam_operasional' => $request->jam_operasional,
                'instagram' => $request->instagram,
                'facebook' => $request->facebook,
            ]);
    
            return redirect()->route('konfigurasi')->with([
                'status' => 'success',
                'message' => 'Konfigurasi berhasil diupdate.',
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'status' => 'error',
                'message' => 'Konfigurasi Gagal diupdate. ' . $e->getMessage(),
            ]);
        }
    }
    
    
    
}
