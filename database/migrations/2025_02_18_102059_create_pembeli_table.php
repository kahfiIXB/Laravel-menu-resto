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
        Schema::create('pembeli', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_menu');
            $table->string('nama_menu');
            $table->string('harga', 20);
            $table->string('stok');
            $table->string('jumlah');
            $table->string('total_harga');
            $table->string('nama_pembeli');
            $table->text('deskripsi_pembeli'); 
            $table->datetime('waktu_membeli'); 
            $table->timestamps();

            $table->foreign('id_menu')->references('id')->on('menu')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembeli');
    }
};