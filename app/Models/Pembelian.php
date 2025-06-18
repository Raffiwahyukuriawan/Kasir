<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    protected $primaryKey = 'id_pembelian';

    protected $fillable = ['no_pembelian','supplier','status','tanggal','nominal','foto'];
}
