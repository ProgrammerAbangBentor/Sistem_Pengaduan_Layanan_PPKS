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
        Schema::table('pengaduans', function (Blueprint $table) {
            $table->string('jenis_identitas')->nullable();
        $table->string('image_identitas')->nullable();
        $table->text('alamat')->nullable();
        $table->string('no_tlp')->nullable();
        $table->string('nama_terlapor')->nullable();
        $table->string('status_terlapor')->nullable();
        $table->string('no_hp_pelapor')->nullable();
        $table->date('tanggal_peristiwa')->nullable();
        $table->string('lokasi_peristiwa')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengaduans', function (Blueprint $table) {
            $table->dropColumn([
                'jenis_identitas',
                'image_identitas',
                'alamat',
                'no_tlp',
                'nama_terlapor',
                'status_terlapor',
                'no_hp_pelapor',
                'tanggal_peristiwa',
                'lokasi_peristiwa',
            ]);
        });
    }
};
