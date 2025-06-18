<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temp_penjualan extends Model
{
    use HasFactory;

    protected $table = 'temp_penjualans';

    protected $fillable = [
        'no_nota',
        'barcode',
        'nama_produk',
        'harga',
        'jumlah',
    ];
}
