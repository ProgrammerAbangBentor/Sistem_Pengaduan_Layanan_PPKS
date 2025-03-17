<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat pengguna admin jika belum ada
        User::firstOrCreate(
            ['email' => 'sabriazis@gmail.com'],
            [
                'name' => 'Admin Sabri azis ',
                'role' => 'admin',
                'password' => Hash::make('123456789'), // Gantilah dengan password yang sesuai
                'email_penerima_akun' => 'admin@gmail.com',
            ]
        )->assignRole('admin');



    }
}
