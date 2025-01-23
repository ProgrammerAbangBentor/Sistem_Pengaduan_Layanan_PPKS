<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\AccountActivationMail;
use Illuminate\Support\Str;
use Carbon\Carbon;  // Pastikan Carbon di-import

class RegisterController extends Controller
{
    // Menampilkan form registrasi
    public function showRegistrationForm(Request $request)
    {
        $user = null;
        if ($request->has('no_identitas') && !empty($request->no_identitas)) {
            // Cari user berdasarkan no_identitas
            $user = User::where('no_identitas', $request->no_identitas)->first();
        }

        // Kirim data $user ke view
        return view('pages.auth.auth-register', compact('user'));
    }

    // Proses pendaftaran
    public function register(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'no_identitas' => 'required|exists:users,no_identitas',
            'email_penerima_akun' => 'required|email|unique:users,email',  // Validasi email yang digunakan
        ]);

        // Cari pengguna berdasarkan no_identitas
        $user = User::where('no_identitas', $request->no_identitas)->first();

        if (!$user) {
            return back()->withErrors(['error' => 'Akun tidak ditemukan dengan nomor identitas tersebut.']);
        }

        // Cek apakah akun sudah aktif
        if ($user->is_active) {
            return redirect()->route('login')->with('info', 'Akun Anda sudah aktif.');
        }

        // Reset attempts jika lebih dari 24 jam sejak percobaan terakhir
        if ($user->last_activation_attempt && Carbon::parse($user->last_activation_attempt)->diffInHours(now()) > 24) {
            $user->activation_attempts = 0; // Reset attempts setelah 24 jam
        }

        // Batasi jumlah percobaan aktivasi hingga 3 kali
        if ($user->activation_attempts >= 3) {
            return back()->withErrors(['error' => 'Anda telah melebihi batas percobaan aktivasi. Coba lagi setelah 24 jam.']);
        }

        // Jika akun belum aktif, buat password jika belum ada
        $randomPassword = $user->generateSimplePassword();
        if (!$user->password) {
            $user->password = Hash::make($randomPassword);
        }

        // set waktu percobaan terakhir
        $user->activation_attempts++;
        $user->last_activation_attempt = now();

        // Membuat token aktivasi
        $activationToken = Str::random(60);

        // Set waktu kadaluarsa token aktivasi 24 jam setelah pembuatan token
        $user->activation_token = $activationToken;
        $user->activation_token_expires_at = now()->addHours(24); // Waktu kadaluarsa 24 jam
        $user->save();

        // Kirim email dengan token aktivasi
        Mail::to($request->email_penerima_akun)->send(new AccountActivationMail($user, $randomPassword, $activationToken));

        return redirect()->back()->with('success', '<b>Pendaftaran berhasil.</b><br> Cek email Anda untuk detail login.');
    }

    // Aktivasi akun berdasarkan token
    public function activateAccount($token)
    {
        // Mencari pengguna berdasarkan token aktivasi
        $user = User::where('activation_token', $token)->first();

        if ($user) {
            // Cek apakah token sudah kadaluarsa
            if ($user->activation_token_expires_at && $user->activation_token_expires_at < now()) {
                return redirect()->route('login')->with('error', 'Token aktivasi telah kadaluarsa.');
            }

            // Aktifkan akun
            $user->is_active = true;
            $user->activation_token = null;  // Hapus token setelah berhasil diaktifkan
            $user->activation_token_expires_at = null;  // Hapus waktu kadaluarsa
            $user->save();

            // Redirect ke login dengan pesan sukses
            return redirect()->route('login')->with('success', 'Akun Anda berhasil diaktifkan. Silakan login.');
        }

        // Jika token tidak ditemukan
        return redirect()->route('login')->with('error', 'Token aktivasi tidak valid.');
    }

    // Halaman sukses registrasi
    public function registrationSuccess()
    {
        return view('pages.auth.registrasi-success');
    }

    // Fungsi untuk admin mengaktifkan atau menonaktifkan akun pengguna
    public function toggleUserActivation($id)
    {
        $user = User::findOrFail($id);

        // Toggle status is_active
        $user->is_active = !$user->is_active;
        $user->save();

        return redirect()->route('admin.users')->with('success', 'Status akun berhasil diperbarui.');
    }
}
