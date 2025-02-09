<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    protected $table = 'pengaduan';
    protected $fillable = [
        'nomor_pengaduan',
        'user_id',
        'pelapor',
        'jenis_identitas',
        'no_identitas',
        'kategori_pengaduan_id',
        'tanggal_peristiwa',
        'kronologi_peristiwa',
        'lokasi_kejadian',
        'file_bukti',
        'kategori_pelapor',
        'nama_tersangka',
        'status_tersangka',
        'no_telfon_tersangka',
        'status',
        'satgas_id',
    ];

    // Relasi dengan tabel KategoriPengaduan
    public function kategori_pengaduan()
    {
        return $this->belongsTo(Kategori_pengaduan::class, 'kategori_pengaduan_id');
    }

    public function keanggotaan()
    {
        return $this->belongsTo(Keanggotaan::class, 'satgas_id');
    }

    public function no_identitas()
    {
        return $this->belongsTo(User::class, 'no_identitas','no_identitas');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function timelines()
    {
        return $this->hasMany(Timeline::class, 'pengaduan_id');
    }

    // Aksesors untuk mengambil file (jika dibutuhkan)
    public function getFileBuktiUrlAttribute()
    {
        return asset('storage/' . $this->file_bukti);
    }

    // Mutators jika diperlukan, misalnya untuk memformat tanggal
    public function getTanggalPeristiwaFormattedAttribute()
    {
        return \Carbon\Carbon::parse($this->tanggal_peristiwa)->format('d-m-Y');
    }

    public static function generateNomorPengaduan()
    {
        $lastPengaduan = self::latest('id')->first();
        $nextNumber = $lastPengaduan ? (int) substr($lastPengaduan->nomor_pengaduan, 1) + 1 : 1;
        return 'P' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
    }
}
