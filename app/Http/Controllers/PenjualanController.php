<?php

namespace App\Http\Controllers;

use App\Models\Detai_penjualan;
use App\Models\Detail_penjualan;
use App\Models\Detail_penjualan as ModelsDetail_penjualan;
use App\Models\Produk;
use App\Models\ProfilToko;
use Illuminate\Http\Request;
use App\Models\Temp_penjualan;
use App\Models\Transaksi;
use Exception;
use Illuminate\Support\Facades\DB;

class PenjualanController
{
    public function penjualan()
    {
        $produks = Produk::all();
        $temp_penjualan = Temp_penjualan::all();
        // dd($produks);
        return view('kasir.pengeluaran', ([
            'title' => 'Penjualan',
            'produks' => $produks,
            'temps' => $temp_penjualan,
        ]));
    }

    public function get_temp()
    {
        $temps = Temp_penjualan::orderBy('created_at', 'desc')->get();

        foreach ($temps as $temp) {
            $temp->total_harga = round($temp->harga * $temp->jumlah);
        }

        return response()->json([
            'success' => true,
            'data' => $temps,
        ]);
    }

    public function getProduk($barcode)
    {
        $produks = Produk::where('barcode', $barcode)->first();

        return response()->json($produks);
    }

    public function checkProduk(Request $request)
    {
        $produk = Temp_penjualan::where('barcode', $request->barcode)->first();

        if ($produk) {
            return response()->json([
                'exists' => true,
                'jumlah' => $produk->jumlah,
            ]);
        } else {
            return response()->json(['exists' => false]);
        }
    }

    public function temp_store(Request $request)
    {
        $produk = Temp_penjualan::where('barcode', $request->barcode)->first();

        if ($produk) {
            $produk->jumlah += $request->jumlah;
            $produk->save();
        } else {
            Temp_penjualan::create([
                'no_nota' => $request->no_nota,
                'nama_produk' => $request->nama_produk,
                'barcode' => $request->barcode,
                'harga' => $request->harga,
                'jumlah' => $request->jumlah,
            ]);
        }

        return response()->json([
            'success' => true,
            'nomor_nota' => $request->no_nota,
        ]);
    }

    public function delete($id)
    {
        $produk = Temp_penjualan::find($id);

        if ($produk) {
            $produk->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function reset_temp()
    {
        try {
            DB::table('temp_penjualans')->truncate(); // Hapus semua data

            return response()->json(['success' => true, 'message' => 'Semua data berhasil dihapus']);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data! ' . $e->getMessage()
            ]);
        }
    }

    public function getNoNota()
    {
        // Mengambil data pertama dari tabel temp_penjualans
        // Metode `first()` akan mengembalikan entri pertama yang ditemukan di tabel
        // Jika tidak ada data di tabel, maka akan mengembalikan `null`
        $nota = Temp_penjualan::first();

        // Mengecek apakah data ditemukan
        if ($nota) {
            // Jika data ditemukan, mengembalikan respons JSON dengan nomor nota yang sudah ada
            // Menyertakan properti `nomor_nota` dari objek $nota
            return response()->json(['nomor_nota' => $nota->no_nota]);
        } else {
            // Jika tidak ada data dalam tabel, maka membuat nomor nota baru
            // Format nomor nota: INV-YYMMDD_XXX (contoh: INV-240218_001)
            // `date('ymd')` menghasilkan tanggal dalam format 2 digit tahun, 2 digit bulan, dan 2 digit hari
            // `rand(1, 999)` menghasilkan angka acak antara 1 hingga 999
            // `str_pad()` digunakan untuk menambah angka acak menjadi 3 digit dengan menambahkan 0 di depan jika kurang dari 3 digit
            $newNota = 'INV-' . date('ymd') . '_' . str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT);

            // Mengembalikan respons JSON dengan nomor nota yang baru
            return response()->json(['nomor_nota' => $newNota]);
        }
    }

    public function proses(Request $request)
    {
        // dd($request);
        $request->validate([
            'bayar' => 'required|numeric|min:1',
            'total_harga' => 'required|numeric|min:1',
            'bukti' => 'nullable|mimes:jpeg,jpg|max:2048', // Validasi bukti transfer
        ]);

        DB::beginTransaction();
        try {
            // Cek apakah ada data dalam temp_penjualan
            $temp_penjualan = Temp_penjualan::all();
            if ($temp_penjualan->isEmpty()) {
                return redirect()->back()->with('error', 'Tidak ada item dalam transaksi!');
            }

            // Ambil no_nota dari temp_penjualan pertama
            $no_nota = Temp_penjualan::first()->no_nota;

            $nama_kasir = session()->get('nama');
            // dd($nama_kasir);
            // Simpan transaksi
            $transaksi = new Transaksi();
            $transaksi->no_nota = $no_nota;
            $transaksi->status = "berhasil";
            $transaksi->tanggal = now();
            $transaksi->total_harga = $request->total_harga;
            $transaksi->bayar = $request->bayar;
            $transaksi->nama_kasir = $nama_kasir;

            // Simpan bukti transfer jika metode pembayaran adalah transfer
            if ($request->pembayaran === 'Transfer' && $request->hasFile('bukti')) {
                $buktiPath = $request->file('bukti')->store('bukti_transfer', 'public');
                $transaksi->bukti_transfer = $buktiPath;
            }

            $transaksi->save();

            // Pindah data dari temp_penjualan ke detail_penjualan
            foreach ($temp_penjualan as $item) {
                Detail_penjualan::create([
                    "no_nota" => $item->no_nota,
                    "barcode" => $item->barcode,
                    "nama_produk" => $item->nama_produk,
                    "harga" => $item->harga,
                    "jumlah" => $item->jumlah,
                    "total_harga" => $item->harga * $item->jumlah,
                ]);

                $produk = Produk::where('barcode', $item->barcode)->first();
                if ($produk->stok >= $item->jumlah) {
                    $produk->stok -= $item->jumlah;
                    $produk->save();
                } else {
                    DB::rollBack();
                    return redirect()->back()->with('error', 'Stok produk ' . $produk->nama_produk . ' tidak mencukupi');
                }
            }

            // Hapus semua data dari temp_penjualan setelah dipindahkan
            Temp_penjualan::query()->delete();

            DB::commit();

            // Redirect ke halaman invoice
            return redirect()->route('invoice/kasir/', ['no_nota' => $no_nota])->with('success', 'Transaksi berhasil!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal melakukan transaksi: ' . $e->getMessage());
        }
    }


    public function invoice($no_nota)
    {
        $transaksi = Transaksi::where('no_nota', $no_nota)->with('detail_penjualan')->first();
        $detail = Detail_penjualan::where('no_nota', $no_nota)->get();
        $konfigurasi = ProfilToko::find(100);

        return view('invoice', [
            'konfigurasi' => $konfigurasi,
            'transaksi' => $transaksi,
            'details' => $detail,
        ]);
    }

    public function invoice_kasir($no_nota)
    {
        $transaksi = Transaksi::where('no_nota', $no_nota)->with('detail_penjualan')->first();
        $detail = Detail_penjualan::where('no_nota', $no_nota)->get();
        $konfigurasi = ProfilToko::find(100);

        return view('kasir.invoice', [
            'konfigurasi' => $konfigurasi,
            'transaksi' => $transaksi,
            'details' => $detail,
        ]);
    }

    public function invoice_cetak($no_nota)
    {
        $details = Detail_penjualan::where('no_nota', $no_nota)->get();
        $transaksi = Transaksi::where('no_nota', $no_nota)->first();
        $konfigurasi = ProfilToko::find(100);

        return view('cetak_invoice', [
            'title' => 'Cetak Nota',
            'konfigurasi' => $konfigurasi,
            'details' => $details,
            'transaksi' => $transaksi,
        ]);
    }

    public function invoice_kasir_cetak($no_nota)
    {
        $details = Detail_penjualan::where('no_nota', $no_nota)->get();
        $transaksi = Transaksi::where('no_nota', $no_nota)->first();
        $konfigurasi = ProfilToko::find(100);

        return view('kasir.cetak_invoice', [
            'title' => 'Cetak Nota',
            'konfigurasi' => $konfigurasi,
            'details' => $details,
            'transaksi' => $transaksi,
        ]);
    }

    public function batalkanPenjualan($no_nota)
    {
        DB::beginTransaction();
        try {
            $detail = Detail_penjualan::where('no_nota', $no_nota)->get();

            if ($detail->isEmpty()) {
                return redirect()->route('transaksi.admin')->with('error', 'Transaksi tidak ditemukan atau sudah dibatalkan');
            }

            // Kembalikan stok produk
            foreach ($detail as $item) {
                $produk = Produk::where('barcode', $item->barcode)->first();
                if ($produk) {
                    $produk->stok += $item->jumlah;
                    $produk->save();
                }
            }

            // Hapus detail transaksi
            Detail_penjualan::where('no_nota', $no_nota)->delete();

            // Update transaksi: ubah status & total harga jadi 0
            Transaksi::where('no_nota', $no_nota)->update([
                'status' => 'Dibatalkan',
                'total_harga' => 0
            ]);

            DB::commit();
            return redirect()->route('transaksi.admin')->with('success', 'Transaksi berhasil dibatalkan, stok dikembalikan, dan total harga menjadi 0');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal membatalkan transaksi: ' . $e->getMessage());
        }
    }


    public function batalkanPenjualanKasir($no_nota)
    {
        DB::beginTransaction();
        try {
            $detail = Detail_penjualan::where('no_nota', $no_nota)->get();

            if ($detail->isEmpty()) {
                return redirect()->route('transaksi.kasir')->with([
                    'status' => 'error',
                    'message' => 'Transaksi tidak ditemukan atau sudah dibatalkan',
                ]);
            }

            // Kembalikan stok produk
            foreach ($detail as $item) {
                $produk = Produk::where('barcode', $item->barcode)->first();
                if ($produk) {
                    $produk->stok += $item->jumlah;
                    $produk->save();
                }
            }

            // Hapus detail transaksi
            Detail_penjualan::where('no_nota', $no_nota)->delete();

            // Update transaksi: ubah status & total harga jadi 0
            Transaksi::where('no_nota', $no_nota)->update([
                'status' => 'Dibatalkan',
                'total_harga' => 0
            ]);

            DB::commit();
            return redirect()->route('transaksi.kasir')->with('success', 'Transaksi berhasil dibatalkan, stok dikembalikan, dan total harga menjadi 0');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal membatalkan transaksi: ' . $e->getMessage());
        }
    }

    public function checkStock($barcode)
    {
        $produk = Produk::where('barcode', $barcode)->first();

        if (!$produk) {
            return response()->json(['error' => 'Produk tidak ditemukan'], 404);
        }

        return response()->json(['stok' => $produk->stok]);
    }
}
