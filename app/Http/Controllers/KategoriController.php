<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController
{
    public function hal_kategori()
    {
        $kategoris = Kategori::orderBy('id', 'desc')->paginate(25)->appends(request()->query());

        return view('kategori', [
            'kategoris' => $kategoris,
            'title' => 'Kategori'
        ]);
    }

    public function add_kategori(Request $request)
    {
        // Validasi kategori
        $validated = $request->validate([
            'kategori' => 'required|string|unique:kategoris,kategori',
        ]);

        try {
            // Menyimpan data kategori ke database
            Kategori::create([
                'kategori' => $request->kategori,
            ]);

            // Kirim status sukses jika berhasil
            return redirect()->route('kategori')->with([
                'status' => 'success',
                'message' => 'Berhasil menambahkan kategori produk.',
            ]);
        } catch (\Exception $e) {
            // Kirim status error jika terjadi kegagalan
            return redirect()->back()->with([
                'status' => 'error',
                'message' => 'Gagal menambahkan kategori produk, periksa kembali apa yang anda input',
                'modal' => 'tambah',
            ])->withInput();
        }
    }

    public function update_kategori(Request $request, $id)
    {
        $cek = $request->validate([
            'kategori' => 'required|string|unique:kategoris,kategori',
        ]);

        try {
            $kategori = Kategori::findOrFail($id);
            $kategori->update([
                'kategori' => $request->input('kategori'),
            ]);

            return redirect()->route('kategori')->with([
                'status' => 'success',
                'message' => 'Kategori berhasil ditambahkan',
            ]);
        } catch (\Exception) {
            return redirect()->route('kategori')->with([
                'status' => 'error',
                'message' => 'Kategori gagal ditambahkan',
            ]);
        }
    }

    public function delete_kategori($id)
    {
        try {
            $kategori = Kategori::findOrFail($id);

            $kategori->delete();

            return redirect()->route('kategori')->with([
                'status' => 'success',
                'message' => 'Kategori berhasil ditambahkan',
            ]);
        } catch (\Exception) {
            return redirect()->route('kategori')->with([
                'status' => 'error',
                'message' => 'Kategori gagal ditambahkan',
            ]);
        }
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $kategories = Kategori::where('kategori', 'LIKE', "%{$keyword}%")
            ->select('id', 'kategori')  // Memilih kolom yang dibutuhkan
            ->get();

        return response()->json($kategories);
    }

    public function get_produk($id)
    {
        // dd($id);
        $kategoris = Kategori::all();
        $produks = Produk::where('id_kategori', $id)->paginate(25);
        // dd($produks);
        //dd($produks);
        return view('produk_kategori', [
            'title' => 'Daftar produk',
            'produks' => $produks,
            'kategoris' => $kategoris,
        ]);
    }
}
