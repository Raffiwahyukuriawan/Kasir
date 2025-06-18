<?php

namespace App\Http\Controllers;

use App\Models\Detai_penjualan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Detail_penjualan;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController
{
    public function admin()
    {
        $salesToday = Detail_penjualan::whereDate('created_at', Carbon::today())
            ->sum(DB::raw('harga * jumlah'));

        $salesThisMonth = Detail_penjualan::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum(DB::raw('harga * jumlah'));

        $salesThisYear = Detail_penjualan::whereYear('created_at', Carbon::now()->year)
            ->sum(DB::raw('harga * jumlah'));

        $BestSellingProduct = Detail_penjualan::select('nama_produk')
            ->selectRaw('SUM(jumlah) as total_sold')
            ->groupBy('nama_produk')
            ->orderByDesc('total_sold')
            ->first();

        $listProduk = Detail_penjualan::select('nama_produk')
            ->selectRaw('SUM(jumlah) as total_sold')
            ->groupBy('nama_produk')
            ->orderByDesc('total_sold')
            ->limit(6)
            ->get();

        $transaksi = Transaksi::orderBy('id')
            ->limit(6)
            ->get();

        $stok_produks = Produk::orderBy('stok', 'asc')
            ->limit(6)
            ->get();

        $produk_terbanyak = Produk::orderBy('stok','desc')
        ->limit(6)
        ->get();

        $transaksi_kasir = Transaksi::select('nama_kasir', DB::raw('COUNT(*) as total_transaksi'))
        ->groupBy('nama_kasir')
        ->orderByDesc('total_transaksi')
        ->limit(6)
        ->get();

        $pengguna = User::all();

        return view('dashboard', [
            'title' => 'Dashboard',
            'salesTodays' => $salesToday,
            'salesThisMonth' => $salesThisMonth,
            'salesThisYear' => $salesThisYear,
            'bestSellingProduct' => $BestSellingProduct,
            'listProduk' => $listProduk,
            'transaksis' => $transaksi,
            'stok_produks' => $stok_produks,
            'produk_terbanyak' => $produk_terbanyak,
            'transaksi_kasir' => $transaksi_kasir,
            'pengguna' => $pengguna
        ]);
    }

    public function getChartData(Request $request)
    {
        $year = $request->query('year', Carbon::now()->year); // Ambil tahun dari request, default ke tahun ini

        $data = Detail_penjualan::selectRaw('MONTH(created_at) as month, SUM(total_harga) as total_harga')
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return response()->json($data);
    }

    public function getChartDataByYear(Request $request)
    {
        $data = Detail_penjualan::selectRaw('YEAR(created_at) as year, SUM(total_harga) as total_harga')
            ->groupBy('year')
            ->orderBy('year')
            ->get();

        // Ambil tahun sekarang & tahun lalu
        $thisYear = Carbon::now()->year;
        $lastYear = $thisYear - 1;

        // Total penjualan tahun ini & tahun lalu
        $thisYearTotal = $data->firstWhere('year', $thisYear)->total_harga ?? 0;
        $lastYearTotal = $data->firstWhere('year', $lastYear)->total_harga ?? 0;

        // Tambahkan ke respons API
        return response()->json([
            'data' => $data,
            'this_year' => $thisYearTotal,
            'last_year' => $lastYearTotal,
        ]);
    }

    public function getChartDataByDay(Request $request)
    {
        $today = Carbon::now();
        $startDate = $today->subDays(29); // Ambil data 30 hari terakhir

        $data = Detail_penjualan::selectRaw('DATE(created_at) as date, SUM(total_harga) as total_harga')
            ->whereBetween('created_at', [$startDate, Carbon::now()])
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return response()->json($data);
    }


    public function kasir()
    {
        $salesToday = Detail_penjualan::whereDate('created_at', Carbon::today())
            ->sum(DB::raw('harga * jumlah'));

        $salesThisMonth = Detail_penjualan::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum(DB::raw('harga * jumlah'));

        $salesThisYear = Detail_penjualan::whereYear('created_at', Carbon::now()->year)
            ->sum(DB::raw('harga * jumlah'));

        $BestSellingProduct = Detail_penjualan::select('nama_produk')
            ->selectRaw('SUM(jumlah) as total_sold')
            ->groupBy('nama_produk')
            ->orderByDesc('total_sold')
            ->first();

        $listProduk = Detail_penjualan::select('nama_produk')
            ->selectRaw('SUM(jumlah) as total_sold')
            ->groupBy('nama_produk')
            ->orderByDesc('total_sold')
            ->limit(6)
            ->get();

        $transaksi = Transaksi::orderBy('id')
            ->limit(6)
            ->get();

        $stok_produks = Produk::orderBy('stok', 'asc')
            ->limit(6)
            ->get();

        $produk_terbanyak = Produk::orderBy('stok','desc')
        ->limit(6)
        ->get();

        $transaksi_kasir = Transaksi::select('nama_kasir', DB::raw('COUNT(*) as total_transaksi'))
        ->groupBy('nama_kasir')
        ->orderByDesc('total_transaksi')
        ->limit(6)
        ->get();

        $pengguna = User::all();

        return view('kasir.dashboard_kasir', [
            'title' => 'Dashboard',
            'salesTodays' => $salesToday,
            'salesThisMonth' => $salesThisMonth,
            'salesThisYear' => $salesThisYear,
            'bestSellingProduct' => $BestSellingProduct,
            'listProduk' => $listProduk,
            'transaksis' => $transaksi,
            'stok_produks' => $stok_produks,
            'produk_terbanyak' => $produk_terbanyak,
            'transaksi_kasir' => $transaksi_kasir,
            'pengguna' => $pengguna
        ]);
    }

    public function manager()
    {
        $salesToday = Detail_penjualan::whereDate('created_at', Carbon::today())
            ->sum(DB::raw('harga * jumlah'));

        $salesThisMonth = Detail_penjualan::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum(DB::raw('harga * jumlah'));

        $salesThisYear = Detail_penjualan::whereYear('created_at', Carbon::now()->year)
            ->sum(DB::raw('harga * jumlah'));

        $BestSellingProduct = Detail_penjualan::select('nama_produk')
            ->selectRaw('SUM(jumlah) as total_sold')
            ->groupBy('nama_produk')
            ->orderByDesc('total_sold')
            ->first();

        $listProduk = Detail_penjualan::select('nama_produk')
            ->selectRaw('SUM(jumlah) as total_sold')
            ->groupBy('nama_produk')
            ->orderByDesc('total_sold')
            ->limit(6)
            ->get();

        $transaksi = Transaksi::orderBy('id')
            ->limit(6)
            ->get();

        $stok_produks = Produk::orderBy('stok', 'asc')
            ->limit(6)
            ->get();

        $produk_terbanyak = Produk::orderBy('stok','desc')
        ->limit(6)
        ->get();

        $transaksi_kasir = Transaksi::select('nama_kasir', DB::raw('COUNT(*) as total_transaksi'))
        ->groupBy('nama_kasir')
        ->orderByDesc('total_transaksi')
        ->limit(6)
        ->get();

        $pengguna = User::all();

        return view('manager.dashboard', [
            'title' => 'Dashboard',
            'salesTodays' => $salesToday,
            'salesThisMonth' => $salesThisMonth,
            'salesThisYear' => $salesThisYear,
            'bestSellingProduct' => $BestSellingProduct,
            'listProduk' => $listProduk,
            'transaksis' => $transaksi,
            'stok_produks' => $stok_produks,
            'produk_terbanyak' => $produk_terbanyak,
            'transaksi_kasir' => $transaksi_kasir,
            'pengguna' => $pengguna
        ]);
    }
}
