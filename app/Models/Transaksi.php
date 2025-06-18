<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksies';
    protected $fillable = ['no_nota', 'status', 'tanggal', 'total_harga'];

    public function detail_penjualan()
    {
        return $this->hasMany(Detail_penjualan::class, 'no_nota', 'no_nota');
    }
}
class Detai_penjualan extends Model
{
    protected $fillable = [
        'no_nota',
        'barcode',
        'nama_produk',
        'harga',
        'jumlah',
        'total_harga',
        'bayar',
        'nama_kasir',
    ];
}
