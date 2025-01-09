<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('pages.auth.auth-register');
    }

    public function register(Request $request)
    {
        // Validasi input pengguna baru
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Membuat user baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_active' => false, // Status akun tidak aktif secara default
        ]);

        // Berikan role "user" secara otomatis
        $user->assignRole('user'); // Jika menggunakan Spatie Laravel Permission

        // Otomatis login setelah registrasi
        Auth::login($user);

        // Redirect ke halaman dashboard atau halaman lain yang kamu inginkan
        return redirect()->route('login');
    }
}
