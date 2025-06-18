<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function pengguna()
    {
        // ambil data
        $users = User::orderBy('id', 'desc')->paginate(25)->appends(request()->query());

        return view('pengguna', [
            'users' => $users,
            'title' => 'Pengguna',
        ]);
    }

    public function store(Request $request)
    {
        $cek1 = $request->validate([
            'nama' => 'required|max:255',
            'password' => 'required',
            'email' => 'required|email|unique:users,email',
            'no_telp' => 'required|regex:/^[0-9]{10,15}$/|unique:users,no_telp',
            'role' => 'required',
        ], [
            'email.unique' => 'Email sudah terdaftar, gunakan email lain.',
        ]);
        try {
            $cek = User::create([
                'nama' => $request->nama,
                'password' => Hash::make($request->password),
                'email' => $request->email,
                'no_telp' => $request->no_telp,
                'role' => $request->role,
            ]);
            // dd($cek);
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

    public function delete($id)
    {
        try {
            $user = User::findOrFail($id);

            $user->delete();

            return redirect()->route('pengguna')->with([
                'status' => 'success',
                'message' => 'Pengguna berhasil dihapus',
            ]);
        } catch (\Exception $e) {
            // dd($e->getMessage());
            return redirect()->route('pengguna')->with([
                'status' => 'error',
                'message' => 'Pengguna gagal dihapus',
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        // dd($id_user);
        $cek = $request->validate([
            'nama' => 'required|string|max:225',
            'email' => 'required|email|unique:users,email',
            'no_telp' => 'required|regex:/^[0-9]{10,15}$/|unique:users,no_telp',
        ]);
        // dd($cek);

        try {
            $user = User::findOrFail($id);
            $user->update([
                'nama' => $request->input('nama'),
                'email' => $request->input('email'),
                'no_telp' => $request->input('no_telp'),
            ]);

            return redirect()->route('pengguna')->with([
                'status' => 'success',
                'message' => 'Pengguna berhasil diupdate',
            ]);
        } catch (\Exception) {
            // dd($e->getMessage());
            return redirect()->route('pengguna')->with([
                'status' => 'error',
                'message' => 'Pengguna gagal diupdate',
            ]);
        }
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $users = User::where('nama', 'LIKE', "%{$keyword}%")
            ->orWhere('email', 'LIKE', "%{$keyword}%")
            ->orWhere('no_telp', 'LIKE', "%{$keyword}%")
            ->orWhere('role', 'LIKE', "%{$keyword}%")
            ->get();

        return response()->json($users);
    }
}
