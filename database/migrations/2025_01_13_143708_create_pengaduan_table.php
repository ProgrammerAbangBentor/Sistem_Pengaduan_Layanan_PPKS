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
        Schema::create('pengaduan', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_pengaduan')->unique();
            $table->enum('pelapor',['Mahasiswa','Dosen','Anonim'])->default('Anonim');
            $table->enum('jenis_identitas',['KTM','NIDN']);
            $table->string('no_identitas');
            $table->date('tanggal_peristiwa');
            $table->text('kronologi_peristiwa');
            //untuk penyimpanan titik maps
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            // (latitude dan longitude)
            $table->string('file_bukti')->nullable();
            $table->enum('status_pelapor',['Mahasiswa','Dosen','Staff Kampus']);
            $table->enum('kategori_pelapor',['Korban','Pelapor/Saksi']);
            $table->string('nama_tersangka');
            $table->enum('status_tersangka',['Mahasiswa','Dosen','Staff Kampus','Masyarakat Umum','Mahasiswa Kampus Lain']);
            $table->string('no_telfon_tersangka');
            $table->foreignId('kategori_pengaduan_id')->constrained('kategori_pengaduan')->onDelete('cascade');
            $table->enum('status', ['Laporan Diterima', 'Sedang Diselidiki', 'Dalam Proses Hukum', 'Kasus Selesai'])->default('Laporan Diterima');
            $table->foreignId('satgas_id')->nullable()->constrained('keanggotaans')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaduan');
    }
};
