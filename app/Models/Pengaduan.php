<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    /**
     * Tabel yang digunakan oleh model ini.
     */
    protected $table = 'pengaduans';

    /**
     * Atribut yang dapat diisi secara massal.
     */
    protected $fillable = [
        'name',
        'user',
        'jenis_identitas',
        'image_identitas',
        'alamat',
        'no_tlp',
        'nama_terlapor',
        'status_terlapor',
        'no_hp_pelapor',
        'laporan',
        'category_id',
        'tanggal_peristiwa',
        'lokasi_peristiwa',
        'file',
        'user_id',
        'updated_by',
    ];

    /**
     * Atribut yang harus diperlakukan sebagai tipe tanggal.
     */
    protected $dates = ['tanggal_peristiwa'];

    /**
     * Relasi dengan model User.
     * Pengaduan milik seorang pengguna.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
    /**
     * Relasi dengan model Category.
     * Pengaduan memiliki satu kategori.
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
