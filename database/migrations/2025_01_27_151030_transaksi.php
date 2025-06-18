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
        Schema::create('transaksies', function(Blueprint $table){
            $table->id();
            $table->string('no_nota');
            $table->enum('status',['berhasil','dibatalkan']);
            $table->date('tanggal');
            $table->integer('total_harga');
            $table->integer('bayar');
            $table->string('nama_kasir');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
