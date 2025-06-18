<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilToko extends Model
{
    protected $table = 'Profil_toko_controllers';
    protected $fillable = ['nama_toko','alamat','email','logo','no_telp','jam_operasional','instagram','facebook'];
}
