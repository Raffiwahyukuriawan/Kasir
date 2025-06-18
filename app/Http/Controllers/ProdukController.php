<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use Exception;
use Illuminate\Http\Request;

class ProdukController
{
    public function index()
    {
        $kategoris = Kategori::all();
        // dd($kategoris);
        $title = 'Produk';
        $produks = Produk::orderBy('id', 'desc')->paginate(25)->appends(request()->query());
        return view('produk', [
            'title' => $title,
            'produks' => $produks,
            'kategoris' => $kategoris,
        ]);
    }

    public function add_produk(Request $request)
    {
        $cek = $request->validate([
            'nama_produk' => 'required||unique:produks,nama_produk',
            'id_kategori' => 'required|exists:kategoris,id',
            'barcode' => 'required|unique:produks,barcode',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
        ]);
        // dd($cek);
        try {
            $cek = Produk::create([
                'nama_produk' => $request->nama_produk,
                'id_kategori' => $request->id_kategori,
                'barcode' => $request->barcode,
                'harga' => $request->harga,
                'stok' => $request->stok,
            ]);

            return redirect()->route('produk')->with([
                'status' => 'success',
                'message' => 'Produk berhasil ditambahkan',
            ]);
        } catch (\Exception) {
            return redirect()->route('produk')->with([
                'status' => 'error',
                'message' => 'Produk gagal ditambahkan',
            ]);
        }
    }

    public function delete($id)
    {
        try {
            $produk = Produk::findOrFail($id);

            $produk->delete();

            return redirect()->route('produk')->with([
                'status' => 'success',
                'message' => 'Produk berhasil dihapus',
            ]);
        } catch (\Exception) {
            return redirect()->route('produk')->with([
                'status' => 'error',
                'message' => 'Produk gagal dihapus',
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        try {

        $cek = $request->validate([
            'nama_produk' => 'required|string|unique:produks,nama_produk',
            'id_kategori' => 'required',
            'barcode' => 'required|string|unique:produks,barcode',
            'harga' => 'required|numeric',
            'stok' => 'required|integer'
        ]);

            $produk = Produk::findOrFail($id);
            $produk->update([
                'nama_produk' => $request->input('nama_produk'),
                'id_kategori' => $request->input('id_kategori'),
                'barcode' => $request->input('barcode'),
                'harga' => $request->input('harga'),
                'stok' => $request->input('stok')
            ]);

            return redirect()->route('produk')->with([
                'status' => 'success',
                'message' => 'Produk berhasil diupdate',
            ]);
        } catch (\Exception $e) {
            // dd($e->getMessage());
            return redirect()->route('produk')->with([
                'status' => 'error',
                'message' => 'Produk gagal diupdate',
            ]);
        }
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $produks = Produk::with('kategori')
            ->where('nama_produk', 'LIKE', "%{$keyword}%")
            ->orWhere('barcode', 'LIKE', "%{$keyword}%")
            ->orWhere('harga', 'LIKE', "%{$keyword}%")
            ->orWhere('stok', 'LIKE', "%{$keyword}%")
            ->orWhereHas('kategori', function ($query) use ($keyword) {
                $query->where('kategori', 'LIKE', "%{$keyword}%");
            })
            ->get();

        return response()->json($produks);
    }
}
