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
        $artikel = Artikel::all();
        return view('pages.dasboard.artikel', compact('artikel'));
    }
}
