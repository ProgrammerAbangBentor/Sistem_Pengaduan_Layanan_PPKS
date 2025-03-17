<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Pengaduan;
use App\Models\Keanggotaan;
use App\Models\Kategori_pengaduan;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $totalUser = User::count();
        $totalPengaduan = Pengaduan::count();
        $KasusSelesai = Pengaduan::where('status', 'Kasus Selesai')->count();
        $jumlahanggotasatgas = Keanggotaan::count();

        $ketua = Keanggotaan::where('jabatan', 'Ketua')->first() ?? (object) [
            'name' => 'Data Ketua belum diisi',
            'jabatan' => 'Ketua',
            'image' => null,

        ];

        $sekretaris = Keanggotaan::where('jabatan', 'Sekretaris')->first() ?? (object) [
            'name' => 'Data Sekretaris belum diisi',
            'jabatan' => 'Sekretaris',
            'image' => null,

        ];

        $anggota = Keanggotaan::where('jabatan', 'Anggota')->get();
        if ($anggota->isEmpty()) {
            $anggota = collect([(object) [
                'name' => 'Data Anggota belum diisi',
                'jabatan' => 'Anggota',
                'image' => null,

            ]]);
        }
        return view('pages.dasboard.landing',  compact('ketua', 'sekretaris', 'anggota', 'totalUser','totalPengaduan','KasusSelesai','jumlahanggotasatgas'));
    }

    public function print(Request $request)
    {
        // Ambil semua kategori pengaduan untuk filter
        $categories = Kategori_pengaduan::all();

        // Query pengaduan dengan filter
        $pengaduans = Pengaduan::with(['user', 'kategoriPengaduan']) // Menggunakan relasi Eloquent
            ->when($request->input('name'), function ($query, $name) {
                $query->where('name', 'like', '%' . $name . '%')
                      ->orWhere('laporan', 'like', '%' . $name . '%');
            })
            ->when($request->input('kategori_pengaduan_id'), function ($query, $categoryId) {
                $query->where('kategori_pengaduan_id', $categoryId);
            })
            ->orderByRaw("CASE
                WHEN status = 'pending' THEN 1
                WHEN status = 'proses' THEN 2
                WHEN status = 'selesai' THEN 3
                ELSE 4
            END")
            ->get();

        // Kirim data ke view
        return view('pages.dasboard.print', compact('pengaduans', 'categories'));
    }


    public function login()
    {
        return view('pages.auth.auth-login');
    }

    public function struktur()
    {
        $ketua = Keanggotaan::where('jabatan', 'Ketua')->first() ?? (object) [
            'name' => 'Data Ketua belum diisi',
            'jabatan' => 'Ketua',
            'image' => null,

        ];

        $sekretaris = Keanggotaan::where('jabatan', 'Sekretaris')->first() ?? (object) [
            'name' => 'Data Sekretaris belum diisi',
            'jabatan' => 'Sekretaris',
            'image' => null,

        ];

        $anggota = Keanggotaan::where('jabatan', 'Anggota')->get();
        if ($anggota->isEmpty()) {
            $anggota = collect([(object) [
                'name' => 'Data Anggota belum diisi',
                'jabatan' => 'Anggota',
                'image' => null,

            ]]);
        }

        return view('pages.dasboard.struktur', compact('ketua', 'sekretaris', 'anggota'));
    }



    public function artikel()
    {
        // Ambil artikel terbaru dengan relasi user (pembuat artikel)
        $artikels = Artikel::with('user')
            ->orderBy('created_at', 'desc') // Urutkan berdasarkan artikel terbaru
            ->get();

        // Kirim data ke view
        return view('pages.dasboard.artikel', compact('artikels'));
    }
}
