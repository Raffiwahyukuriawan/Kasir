<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('profil_toko_controllers', function (Blueprint $table) {
            $table->id();
            $table->string('nama_toko');
            $table->string('alamat');
            $table->string('no_telp');
            $table->string('email');
            $table->string('logo');
            $table->string('jam_operasional');
            $table->string('instagram');
            $table->string('facebook');
            $table->string('tiktok');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profil_toko_controllers');
    }
};
