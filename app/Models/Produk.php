<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = ['nama_produk', 'barcode', 'id_kategori', 'harga', 'stok'];

    // 1 produk punya 1 kategori
    // one to one
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }
}
