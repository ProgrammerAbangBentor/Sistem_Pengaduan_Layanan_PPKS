<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    // Relasi ke pengaduan
    public function pengaduan(): HasMany
    {
        return $this->hasMany(Pengaduan::class);
    }

    // Menangani event deleting untuk mencegah penghapusan
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($category) {
            if ($category->pengaduan()->exists()) {
                // Memunculkan exception jika kategori sedang digunakan di pengaduan
                throw new \Exception("Kategori ini tidak dapat dihapus karena sedang digunakan di tabel pengaduan.");
            }
        });
    }
   
}
