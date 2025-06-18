<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\Pembelian;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class KeuanganController
{
    public function index()
    {
        $pembelians = Pembelian::orderBy('id_pembelian', 'desc')->paginate(25)->appends(request()->query());
        $suppliers = Supplier::all();
        $laporan = Transaksi::select(DB::raw('DATE_FORMAT(created_at, "%Y-%m") as bulan'), DB::raw('SUM(total_harga) as total_pendapatan'))
            ->groupBy('bulan')
            ->orderBy('bulan', 'desc')
            ->paginate(25);

        return view('keuangan', [
            'pembelians' => $pembelians,
            'title' => 'Pendapatan',
            'suppliers' => $suppliers,
            'laporan' => $laporan,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'supplier' => 'required|string',
            'nominal' => 'required',
            'foto' => 'required|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filepath = $file->store('uploads', $filename, 'public');
            dd($filepath);
        }

        $lastPembelian = Pembelian::max('no_pembelian') ?? 0;
        $newNumber = $lastPembelian + 1;
        dd($newNumber);

        try {
            Pembelian::create([
                'no_pembelian' => $newNumber,
                'supplier' => $request->supplier,
                'status' => 'berhasil',
                'tanggal' => now(),
                'nominal' => $request->nominal,
                'foto' => $fotoPath ?? null,
            ]);
            // Kirim status sukses jika berhasil
            return redirect()->route('pembelian')->with([
                'status' => 'success',
                'message' => 'Berhasil menambahkan pembelian.',
            ]);
        } catch (\Exception $e) {
            // dd($e->getMessage());
            // Kirim status error jika terjadi kegagalan
            return redirect()->back()->with([
                'status' => 'error',
                'message' => 'Gagal menambahkan pembelian, periksa kembali apa yang anda input',
                'modal' => 'tambah',
            ])->withInput();
        }
    }

    public function laba_rugi()
    {
        $laporan = DB::table('transaksies')
            ->select(
                DB::raw('DATE_FORMAT(created_at, "%Y-%m") as bulan'),
                DB::raw('SUM(total_harga) as total_pendapatan')
            )
            ->groupBy('bulan')
            ->orderBy('bulan', 'asc')
            ->get();

        // Ambil total pengeluaran per bulan dari tabel pengeluarans
        $pengeluaran = DB::table('pengeluarans')
            ->select(
                DB::raw('DATE_FORMAT(created_at, "%Y-%m") as bulan'),
                DB::raw('SUM(total_pengeluaran) as total_pengeluaran')
            )
            ->groupBy('bulan')
            ->pluck('total_pengeluaran', 'bulan'); // (bulan => total_pengeluaran)

        // Gabungkan data pendapatan dan pengeluaran
        foreach ($laporan as $item) {
            $item->total_pengeluaran = $pengeluaran[$item->bulan] ?? 0;
            $item->laba_rugi = $item->total_pendapatan - $item->total_pengeluaran;
        }

        return view('laba_rugi', [
            'title' => 'Laba Rugi',
            'laporans' => $laporan
        ]);
    }

    // Tambahkan ini untuk API JSON agar bisa dipakai di Chart.js
    public function labaRugiChart()
    {
        $laporan = DB::table('transaksies')
            ->select(
                DB::raw('DATE_FORMAT(created_at, "%Y-%m") as bulan'),
                DB::raw('SUM(total_harga) as total_pendapatan')
            )
            ->groupBy('bulan')
            ->orderBy('bulan', 'asc')
            ->get();

        $pengeluaran = DB::table('pengeluarans')
            ->select(
                DB::raw('DATE_FORMAT(created_at, "%Y-%m") as bulan'),
                DB::raw('SUM(total_pengeluaran) as total_pengeluaran')
            )
            ->groupBy('bulan')
            ->pluck('total_pengeluaran', 'bulan');

        foreach ($laporan as $item) {
            $item->total_pengeluaran = $pengeluaran[$item->bulan] ?? 0;
            $item->laba_rugi = $item->total_pendapatan - $item->total_pengeluaran;
        }

        return response()->json($laporan);
    }

    public function arus_kas()
    {
        $laporan = DB::table('transaksies')
            ->select(
                DB::raw('DATE_FORMAT(created_at, "%Y-%m") as bulan'),
                DB::raw('SUM(total_harga) as total_pendapatan')
            )
            ->groupBy('bulan')
            ->orderBy('bulan', 'desc')
            ->get();

        $pengeluaran = DB::table('pengeluarans')
        ->select(
            DB::raw('DATE_FORMAT(created_at, "%Y-%m") as bulan'),
            DB::raw('SUM(total_pengeluaran) as total_pengeluaran')
        )
        ->groupBy('bulan')
        ->pluck('total_pengeluaran','bulan');

        foreach ($laporan as $item){
            $item->total_pengeluaran = $pengeluaran[$item->bulan]??0;
            $item->laba_rugi = $item->total_pendapatan-$item->total_pengeluaran;
        }
        $pdf = Pdf::loadView('laporan.pdf', compact('laporan'))
            ->setPaper('a4', 'portrait')
            ->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);

        return $pdf->download('Laporan_keuangan.pdf');
    }

    public function manager()
    {
        $laporan = DB::table('transaksies')
            ->select(
                DB::raw('DATE_FORMAT(created_at, "%Y-%m") as bulan'),
                DB::raw('SUM(total_harga) as total_pendapatan')
            )
            ->groupBy('bulan')
            ->orderBy('bulan', 'asc')
            ->get();

        // Ambil total pengeluaran per bulan dari tabel pengeluarans
        $pengeluaran = DB::table('pengeluarans')
            ->select(
                DB::raw('DATE_FORMAT(created_at, "%Y-%m") as bulan'),
                DB::raw('SUM(total_pengeluaran) as total_pengeluaran')
            )
            ->groupBy('bulan')
            ->pluck('total_pengeluaran', 'bulan'); // (bulan => total_pengeluaran)

        // Gabungkan data pendapatan dan pengeluaran
        foreach ($laporan as $item) {
            $item->total_pengeluaran = $pengeluaran[$item->bulan] ?? 0;
            $item->laba_rugi = $item->total_pendapatan - $item->total_pengeluaran;
        }

        return view('manager.laba_rugi', [
            'title' => 'Laba Rugi',
            'laporans' => $laporan
        ]);
    }
}
