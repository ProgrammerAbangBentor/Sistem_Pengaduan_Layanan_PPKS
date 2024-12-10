<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckActiveUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah pengguna sudah login dan status aktif
        if (Auth::check() && !Auth::user()->is_active) {
            // Jika pengguna tidak aktif, logout dan arahkan ke halaman login
            Auth::logout();

            // Kirim pesan error menggunakan session
            return redirect()->route('login')->with('error', 'Your account has been deactivated.');
        }

        // Jika pengguna aktif, lanjutkan permintaan
        return $next($request);
    }
}
