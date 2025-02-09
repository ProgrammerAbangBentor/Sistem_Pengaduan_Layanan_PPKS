<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori_pengaduan extends Model
{
    use HasFactory;

    protected $table = 'kategori_pengaduan';

    protected $fillable = [
        'name',
        'keterangan'
    ];

    public function pengaduan()
    {
        return $this->hasMany(Pengaduan::class, 'kategori_pengaduan_id');
    }
}
