<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user',
        'status',
        'laporan',
        'file',
        'user_id',
        'category_id',
    ];
     public function category()
        {
            return $this->belongsTo(Category::class);
        }
}
