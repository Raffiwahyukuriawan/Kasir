<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    protected $fillable = ['tanggal', 'kategori', 'deskripsi', 'total_pengeluaran'];
}
