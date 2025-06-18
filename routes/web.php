<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\KonfigurasiController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\TransaksiController;
use App\Models\Transaksi;

Route::middleware(['auth', RoleMiddleware::class . ':manager'])->group(function () {
    Route::get('/dashboard/manager', [DashboardController::class, 'manager'])->name('manager');

    Route::get('/manager/get_chart', [DashboardController::class, 'getChartData'])->name('manager.chart.data');

    Route::get('/manager/get_chart/by/year', [DashboardController::class, 'getChartDataByYear'])->name('manager.chart.data.year');

    Route::get('/manager/get_chart/by/Day', [DashboardController::class, 'getChartDataByDay'])->name('manager.chart.data.daily');

    // keuangan
    Route::get('/keuangan/manager', [KeuanganController::class, 'manager'])->name('keuangan.manager');

    Route::put('/keuangan/update//manager{no_pembelian}', [KeuanganController::class, 'update'])->name('pembelian.update');

    Route::delete('/keuangan/delete/manager{no_pembelian}', [KeuanganController::class, 'delete'])->name('pembelian.delete');

    Route::post('/keuangan/store/manager', [KeuanganController::class, 'store'])->name('pembelian.store');

    Route::get('/api/laba-rugi/manager', [KeuanganController::class, 'labaRugiChart']);

    Route::get('/keuangan/search/manager', [KeuanganController::class, 'search'])->name('pembelian.search');
});

Route::middleware(['auth', RoleMiddleware::class . ':admin'])->group(function () {
    Route::get('/', [DashboardController::class, 'admin'])->name('/');

    Route::get('/admin/get_chart', [DashboardController::class, 'getChartData'])->name('chart.data');

    Route::get('/admin/get_chart/by/year', [DashboardController::class, 'getChartDataByYear'])->name('chart.data.year');

    Route::get('/admin/get_chart/by/Day', [DashboardController::class, 'getChartDataByDay'])->name('chart.data.daily');

    Route::get('/pengeluaran', [PengeluaranController::class, 'index'])->name('pengeluaran');

    Route::post('/admin/penjualan/store', [PengeluaranController::class, 'store'])->name('pengeluaran.store');

    Route::get('/laba_rugi', [KeuanganController::class, 'laba_rugi'])->name('laba.rugi');

    Route::get('/admin/penjualan/arus_kas', [KeuanganController::class, 'arus_kas'])->name('arus.kas');

    Route::get('/konfigurasi', [KonfigurasiController::class, 'index'])->name('konfigurasi');

    Route::put('/konfigurasi/update/{id}', [KonfigurasiController::class, 'update'])->name('konfigurasi.update');

    Route::get('/invoice/{no_nota}', [PenjualanController::class, 'invoice'])->name('invoice');

    Route::get('/invoice/cetak/{no_nota}', [PenjualanController::class, 'invoice_cetak'])->name('cetak');

    Route::get('/produk', [ProdukController::class, 'index'])->name('produk');

    Route::post('/produk/add', [ProdukController::class, 'add_produk'])->name('add.produk');

    Route::delete('/produk/{id}', [ProdukController::class, 'delete']);

    Route::put('/produk/update/{id}', [ProdukController::class, 'update'])->name('produk.update');

    Route::get('/produk/search', [ProdukController::class, 'search']);

    Route::get('/pengguna', [UserController::class, 'pengguna'])->name('pengguna');

    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');

    Route::delete('/users/{id}', [UserController::class, 'delete'])->name('users.delete');

    Route::put('/users/update/{id}', [UserController::class, 'update'])->name('user.update');

    Route::get('/users/search', [UserController::class, 'search'])->name('users.search');

    Route::get('/transaksi/admin', [TransaksiController::class, 'index'])->name('transaksi.admin');

    Route::delete('/penjualan/admin/batal/{no_nota}', [PenjualanController::class, 'batalkanPenjualan'])->name('batal_penjualan');

    Route::delete('/penjualan/delete/{id}', [TransaksiController::class, 'delete'])->name('temp_penjualan.delete');

    Route::get('/kategori', [KategoriController::class, 'hal_kategori'])->name('kategori');

    Route::post('/kategori/add', [KategoriController::class, 'add_kategori'])->name('add.kategori');

    Route::put('/kategori/update/{id}', [KategoriController::class, 'update_kategori'])->name('update.kategori');

    Route::delete('kategori/{id}', [KategoriController::class, 'delete_kategori'])->name('delete.kategori');

    Route::get('/kategori/search', [KategoriController::class, 'search']);

    Route::get('/produk_kategori/{id}', [KategoriController::class, 'get_produk'])->name('produk_kategori');

    Route::get('/supplier', [SupplierController::class, 'index'])->name('supplier');

    Route::put('/supplier/update/{id}', [SupplierController::class, 'update'])->name('supplier.update');

    Route::delete('/supplier/delete/{id}', [SupplierController::class, 'delete'])->name('supplier.delete');

    Route::post('/supplier/store', [SupplierController::class, 'store'])->name('supplier.store');

    Route::get('/supplier/search', [SupplierController::class, 'search']);

    // keuangan
    Route::get('/keuangan', [KeuanganController::class, 'index'])->name('keuangan');

    Route::put('/keuangan/update/{no_pembelian}', [KeuanganController::class, 'update'])->name('pembelian.update');

    Route::delete('/keuangan/delete/{no_pembelian}', [KeuanganController::class, 'delete'])->name('pembelian.delete');

    Route::post('/keuangan/store', [KeuanganController::class, 'store'])->name('pembelian.store');

    Route::get('/api/laba-rugi', [KeuanganController::class, 'labaRugiChart']);

    Route::get('/keuangan/search', [KeuanganController::class, 'search'])->name('pembelian.search');
});

Route::middleware(['auth', 'role:kasir'])->group(function () {
    Route::get('/dashboard_kasir', [DashboardController::class, 'kasir'])->name('dashboard_kasir');

    Route::get('/kasir/get_charts', [DashboardController::class, 'getChartData'])->name('kasir.chart.data');

    Route::get('/kasir/get_chart/by/years', [DashboardController::class, 'getChartDataByYear'])->name('kasir.chart.data.year');

    Route::get('/kasir/get_chart/by/Days', [DashboardController::class, 'getChartDataByDay'])->name('kasir.chart.data.daily');

    Route::get('/invoice/kasir/{no_nota}', [PenjualanController::class, 'invoice_kasir'])->name('invoice/kasir/');

    Route::get('/transaksi/kasir', [TransaksiController::class, 'kasir'])->name('transaksi.kasir');

    Route::get('/invoice/kasir/cetak/{no_nota}', [PenjualanController::class, 'invoice_kasir_cetak'])->name('cetak.kasir');

    Route::get('/penjualan', [PenjualanController::class, 'penjualan'])->name('penjualan');

    Route::post('/penjualan', [PenjualanController::class, 'temp_store'])->name('temp_penjualan.store');

    Route::delete('/penjualan/kasir/batal/{no_nota}', [PenjualanController::class, 'batalkanPenjualanKasir'])->name('batal.penjualan.kasir');

    Route::delete('/penjualan/kasir/delete/{id}', [TransaksiController::class, 'kasirDelete'])->name('temp.penjualan.kasir.delete');

    Route::get('/penjualan/check-stock/{barcode}', [PenjualanController::class, 'checkStock']);

    Route::delete('/penjualan/delete/{id}',  [PenjualanController::class, 'delete'])->name('penjualan.delete');


});


Route::middleware(['auth', 'role:manager'])->group(function () {
    Route::get('/manager', [DashboardController::class, 'manager']);
});

Route::middleware(['auth', 'role:kasir'])->group(function () {
    Route::get('/kasir', [DashboardController::class, 'kasir']);
});


Route::get('/transaksi/search', [TransaksiController::class, 'search']);


// penjualan
Route::middleware('auth', 'role:kasir')->group(function () {});

Route::get('/get_temp', [PenjualanController::class, 'get_temp'])->name('get_temp');

Route::get('/get-produk/{barcode}', [PenjualanController::class, 'getProduk']);

Route::post('/temp-penjualan/reset', [PenjualanController::class, 'reset_temp'])->name(('temp_penjualan.reset'));

Route::get('/penjualan/get-no-nota', [PenjualanController::class, 'getNoNota']);

Route::post('/penjualan/check', [PenjualanController::class, 'checkProduk'])->name('temp_penjualan.check');

Route::post('/penjualan/proses', [PenjualanController::class, 'proses'])->name('proses_penjualan');

Route::get('/invoice', [PenjualanController::class, 'invoice'])->name('penjualan.invoice');

// login logout
Route::get('/login', [AuthController::class, 'auth'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'destroy'])->name('logout');
