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
            $table->string('user_id');
            $table->string('nomor_pengaduan')->unique();
            $table->enum('pelapor',['Mahasiswa','Dosen','Staff Kampus','Anonim'])->default('Anonim');
            $table->enum('jenis_identitas',['KTM','NIDN','KTP']);
            $table->string('no_identitas');
            $table->string('bukti_identitas')->nullable();
            $table->date('tanggal_peristiwa');
            $table->text('kronologi_peristiwa');
            //untuk penyimpanan titik maps
            $table->string('lokasi_kejadian')->nullable();
            $table->string('file_bukti')->nullable();
            $table->enum('kategori_pelapor',['Korban','Pelapor/Saksi']);
            $table->string('nama_tersangka');
            $table->enum('status_tersangka',['Mahasiswa','Dosen','Staff Kampus','Masyarakat Umum','Mahasiswa Kampus Lain']);
            $table->string('no_telfon_tersangka');
            $table->foreignId('kategori_pengaduan_id')->constrained('kategori_pengaduan')->onDelete('cascade');
            $table->enum('status', ['Laporan Diterima', 'Sedang Diselidiki', 'Dalam Proses Hukum', 'Kasus Selesai'])->default('Laporan Diterima');
            $table->foreignId('satgas_id')->nullable()->constrained('keanggotaans')->onDelete('set null');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
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
