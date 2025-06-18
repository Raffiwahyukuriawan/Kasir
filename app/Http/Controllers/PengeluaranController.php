<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PengeluaranController
{
    public function index()
    {
        // ambil data
        $pengeluarans = Pengeluaran::orderBy('id', 'desc')->paginate(25)->appends(request()->query());

        return view('pengeluaran', [
            'pengeluarans' => $pengeluarans,
            'title' => 'Pengeluaran',
        ]);
    }

    public function store(Request $request)
    {
        // dd($request);
        try {
            $request->validate([
                'tanggal' => 'required|date',
                'kategori' => 'required|string|max:100',
                'deskripsi' => 'required|string',
                'total_pengeluaran' => 'required|numeric'
            ]);

            Pengeluaran::create($request->all());
            // dd($cek);
            return redirect()->route('pengeluaran')->with([
                'status' => 'success',
                'message' => 'pengeluaran berhasil ditambahkan',
            ]);
        } catch (\Exception) {
            return redirect()->route('pengeluaran')->with([
                'status' => 'error',
                'message' => 'pengeluaran gagal ditambahkan',
            ]);
        }
    }

    public function delete($id)
    {
        try {
            $user = Pengeluaran::findOrFail($id);

            $user->delete();

            return redirect()->route('pengguna')->with([
                'status' => 'success',
                'message' => 'Pengguna berhasil ditambahkan',
            ]);
        } catch (\Exception) {
            return redirect()->route('pengguna')->with([
                'status' => 'error',
                'message' => 'Pengguna gagal ditambahkan',
            ]);
        }
    }

    public function update(Request $request, $id_user)
    {
        try {
            // dd($id_user);
            $cek = $request->validate([
                'nama' => 'required|string|max:225',
                'email' => 'required|email|unique:users,email,' . $id_user . ',id_user',
                'no_telp' => 'required|regex:/^[0-9]{10,15}$/',
            ]);
            dd($cek);

            $user = Pengeluaran::findOrFail($id_user);
            $user->update([
                'nama' => $request->input('nama'),
                'email' => $request->input('email'),
                'no_telp' => $request->input('no_telp'),
            ]);

            return redirect()->route('pengguna')->with([
                'status' => 'success',
                'message' => 'Pengguna berhasil ditambahkan',
            ]);
        } catch (\Exception) {
            return redirect()->route('pengguna')->with([
                'status' => 'error',
                'message' => 'Pengguna gagal ditambahkan',
            ]);
        }
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $users = Pengeluaran::where('nama', 'LIKE', "%{$keyword}%")
            ->orWhere('email', 'LIKE', "%{$keyword}%")
            ->orWhere('no_telp', 'LIKE', "%{$keyword}%")
            ->orWhere('role', 'LIKE', "%{$keyword}%")
            ->get();

        return response()->json($users);
    }
   
}
