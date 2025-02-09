<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keanggotaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'jabatan','status','no_telp', 'image'
    ];

    public function pengaduan()
    {
        return $this->hasMany(Pengaduan::class, 'satgas_id');
    }

    public function timeline()
    {
        return $this->hasMany(Timeline::class, 'satgas_id');
    }
}
