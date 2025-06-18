<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detail_penjualan extends Model
{
    protected $fillable = [
        'no_nota',
        'barcode',
        'nama_produk',
        'harga',
        'jumlah',
        'total_harga',
    ];
}
