<?php

namespace App\Http\Controllers;

use App\Models\Detail_penjualan;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController
{
    public function index()
    {
        $transaksies = Transaksi::orderBy('id', 'desc')->paginate(10);
        // dd($transaksies);
        return view('transaksi', [
            'title' => 'Transaksi',
            'transaksies' => $transaksies,
        ]);
    }

    public function kasir()
    {
        $transaksies = Transaksi::orderBy('id', 'desc')->paginate(10);
        // dd($transaksies);
        return view('kasir.transaksi', [
            'title' => 'Transaksi',
            'transaksies' => $transaksies,
        ]);
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $transaksis = Transaksi::where('no_nota', 'LIKE', "%{$keyword}%")
            ->orWhere('status', 'LIKE', "%{$keyword}%")
            ->orWhere('tanggal', 'LIKE', "%{$keyword}%")
            ->orWhere('total_harga', 'LIKE', "%{$keyword}%")
            ->get();

        return response()->json($transaksis);
    }

    public function delete($id)
    {
        try {
            // Cari transaksi berdasarkan ID
            $transaksi = Transaksi::find($id);
    
            // Jika transaksi tidak ditemukan, kembalikan pesan error
            if (!$transaksi) {
                return redirect()->route('transaksi.admin')->with([
                    'status' => 'error',
                    'message' => 'Transaksi tidak ditemukan',
                ]);
            }
    
            // Hapus semua detail_penjualan yang terkait dengan transaksi ini
            Detail_penjualan::where('no_nota', $transaksi->no_nota)->delete();
    
            // Hapus transaksi utama
            $transaksi->delete();
    
            return redirect()->route('transaksi.admin')->with([
                'status' => 'success',
                'message' => 'Transaksi dan detail penjualan berhasil dihapus',
            ]);
        } catch (\Exception $e) {
            return redirect()->route('transaksi.admin')->with([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ]);
        }
    }
    
    public function kasirDelete($id)
    {
        try {
            // Cari transaksi berdasarkan ID
            $transaksi = Transaksi::find($id);
    
            // Jika transaksi tidak ditemukan, kembalikan pesan error
            if (!$transaksi) {
                return redirect()->route('transaksi.kasir')->with([
                    'status' => 'error',
                    'message' => 'Transaksi tidak ditemukan',
                ]);
            }
    
            // Hapus semua detail_penjualan yang terkait dengan transaksi ini
            Detail_penjualan::where('no_nota', $transaksi->no_nota)->delete();
    
            // Hapus transaksi utama
            $transaksi->delete();
    
            return redirect()->route('transaksi.kasir')->with([
                'status' => 'success',
                'message' => 'Transaksi dan detail penjualan berhasil dihapus',
            ]);
        } catch (\Exception $e) {
            return redirect()->route('transaksi.kasir')->with([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ]);
        }
    }
}
