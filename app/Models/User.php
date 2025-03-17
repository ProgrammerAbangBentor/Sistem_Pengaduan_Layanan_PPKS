<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'no_identitas',
        'email',
        'email_penerima_akun',
        'password',
        'role',
        'is_active',
        'activation_token',
        'activation_token_expires_at',  // Menambahkan kolom activation_token_expires_at
        'profile_image',  // Menambahkan kolom profile_image
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'activation_token',  // Menambahkan activation_token agar tidak disertakan dalam response
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_active' => 'boolean',
        'activation_token' => 'string',
        'activation_token_expires_at' => 'datetime',  // Meng-cast activation_token_expires_at sebagai datetime
    ];

    /**
     * Relasi many-to-many dengan Role.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(\Spatie\Permission\Models\Role::class, 'model_has_roles', 'model_id', 'role_id');
    }

    /**
     * Relasi one-to-many dengan Pengaduan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pengaduan()
    {
        return $this->hasMany(Pengaduan::class, 'no_identitas', 'no_identitas');
    }
    public function user()
    {
        return $this->hasMany(Pengaduan::class, 'user_id', 'id');
    }

    /**
     * Cek apakah pengguna aktif.
     *
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->is_active;
    }

    /**
     * Generate password sederhana.
     *
     * @return string
     */
    public function generateSimplePassword()
    {
        $prefix = 'User';
        $year = date('Y');
        $symbol = '!';

        $password = $prefix . $year . $symbol;

        return $password;
    }

    /**
     * Mutator untuk set waktu kadaluarsa token aktivasi.
     * Token akan kadaluarsa 24 jam setelah dibuat.
     *
     * @return void
     */
    public function setActivationTokenExpiresAtAttribute($value)
    {
        // Set waktu kadaluarsa token selama 24 jam setelah token dibuat
        $this->attributes['activation_token_expires_at'] = now()->addHours(24);
    }

    /**
     * Cek apakah token aktivasi sudah kadaluarsa.
     *
     * @return bool
     */
    public function isActivationTokenExpired(): bool
    {
        return $this->activation_token_expires_at && $this->activation_token_expires_at < now();
    }
}
