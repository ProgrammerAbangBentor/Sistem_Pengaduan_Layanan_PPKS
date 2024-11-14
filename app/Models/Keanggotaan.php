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
}
