<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Keanggotaan;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('pages.dasboard.index');
    }

    public function login()
    {
        return view('pages.auth.auth-login');
    }

    public function struktur()
    {
        $ketua = Keanggotaan::where('jabatan', 'Ketua')->first();
        $sekretaris = Keanggotaan::where('jabatan', 'Sekretaris')->first();
        $anggota = Keanggotaan::where('jabatan', 'Anggota')->get();

        $ketua = $ketua ?? 'Data Ketua belum diisi';
        $sekretaris = $sekretaris ?? 'Data Sekretaris belum diisi';
        $anggota = $anggota->isEmpty() ? ['Data Anggota belum diisi'] : $anggota;


        return view('pages.dasboard.struktur', compact('ketua' , 'sekretaris' , 'anggota'));
    }

    public function artikel()
    {
         // Ambil artikel terbaru dengan relasi user (pembuat artikel)
    $artikels = Artikel::with('user')
    ->orderBy('created_at', 'desc') // Urutkan berdasarkan artikel terbaru
    ->get();

// Jika tidak ada artikel, beri pesan default
$artikels = $artikels->isEmpty() ? null : $artikels;

return view('pages.dasboard.artikel', compact('artikels'));   }
}
