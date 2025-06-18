<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;
use App\Models\Produk;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Hapus data lama sebelum seeding
        Kategori::factory(50)->create();

        // Tambahkan data baru
        Produk::factory(100)->create();
    }
}
