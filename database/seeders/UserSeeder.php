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
            ['email' => 'nirfan@gmail.com'],
            [
                'name' => 'Admin Nirfanto ',
                'role' => 'admin',
                'password' => Hash::make('123456789'), // Gantilah dengan password yang sesuai
            ]
        )->assignRole('admin');

        User::firstOrCreate(
            ['email' => 'tes@gmail.com'],
            [
                'name' => 'user ',
                'role' => 'user',
                'password' => Hash::make('123456789'), // Gantilah dengan password yang sesuai
            ]
        )->assignRole('user');

    }
}
