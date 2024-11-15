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
        Schema::create('pengaduans', function (Blueprint $table) {
            $table->id();
            $table->enum('user', ['Mahasiswa', 'Dosen', 'anonim'])->default('anonim');
            $table->enum('status', ['pending', 'proses', 'selesai'])->default('pending');
            $table->string('name'); // Nama pelapor
            $table->text('laporan'); // Laporan yang dibuat
            $table->string('image')->nullable(); // Path gambar, boleh kosong
            $table->timestamps(); // Created_at dan updated_at otomatis


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaduans');
    }
};
