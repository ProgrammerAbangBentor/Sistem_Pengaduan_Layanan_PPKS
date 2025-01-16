<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\AccountActivationMail;
use Illuminate\Support\Str;


class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('pages.auth.auth-register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'no_identitas' => 'required|exists:users,no_identitas',
            'email' => 'required|email',
        ]);

        $user = User::where('no_identitas', $request->no_identitas)->first();
        if (!$user) {
            return back()->withErrors(['error' => 'Akun tidak ditemukan dengan nomor identitas tersebut.']);
        }

        if ($user->is_active) {
            return redirect()->route('login')->with('info', 'Akun Anda sudah aktif.');
        }

        //jika belum aktif
        $user->is_active = true;

        $randomPassword = $user->generateSimplePassword();
        if (!$user->password) {
            $user->password = Hash::make($randomPassword);
        }
        $user->save();

         Mail::to($request->email)->send(new AccountActivationMail($user, $randomPassword));

         return redirect()->back()->with('success', '<b>Pendaftaran berhasil.</b><br> Cek email Anda untuk detail login.');
    }

    public function activateAccount($token)
    {
        $user = User::where('email', $token)->first();
        if ($user) {
            $user->is_active = true;
            $user->save();

            return redirect('/login')->with('success', 'Akun berhasil diaktifkan.');
        }

        return redirect('/login')->with('error', 'Token aktivasi tidak valid.');
    }

    public function registrationSuccess()
    {
        return view('pages.auth.registrasi-success');
    }

}
