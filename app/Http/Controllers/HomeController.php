<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Pengaduan;
use App\Models\Keanggotaan;
use App\Models\Category;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('pages.dasboard.index');
    }
    public function print(Request $request)
    {
        $categories = Category::all();
        $pengaduans = Pengaduan::query()
            ->join('users', 'pengaduans.user_id', '=', 'users.id')
            ->join('categories', 'pengaduans.category_id', '=', 'categories.id')
            ->select('pengaduans.*', 'users.email as user_email', 'categories.name as category_name')
            ->when($request->input('name'), function ($query, $name) {
                $query->where('pengaduans.name', 'like', '%' . $name . '%')
                      ->orWhere('pengaduans.laporan', 'like', '%' . $name . '%');
            })
            ->when($request->input('category_id'), function ($query, $categoryId) {
                $query->where('pengaduans.category_id', $categoryId);
            })->orderByRaw("CASE
            WHEN status = 'pending' THEN 1
            WHEN status = 'proses' THEN 2
            WHEN status = 'selesai' THEN 3
            ELSE 4
        END")
        ->paginate(10);
        return view('pages.dasboard.print', compact('pengaduans', 'categories'));
    }

    public function login()
    {
        return view('pages.auth.auth-login');
    }

    public function struktur()
    {
        // Mengambil data anggota dengan jabatan tertentu
        $ketua = Keanggotaan::where('jabatan', 'Ketua')->first();
        $sekretaris = Keanggotaan::where('jabatan', 'Sekretaris')->first();
        $anggota = Keanggotaan::where('jabatan', 'Anggota')->get();

        // Menggunakan nilai default jika data tidak ditemukan
        $ketua = $ketua ?? (object) ['name' => 'Data Ketua belum diisi', 'image' => null, 'description' => ''];
        $sekretaris = $sekretaris ?? (object) ['name' => 'Data Sekretaris belum diisi', 'image' => null, 'description' => ''];
        $anggota = $anggota->isEmpty() ? [(object) ['name' => 'Data Anggota belum diisi', 'image' => null, 'description' => '']] : $anggota;

        // Mengirimkan data ke view
        return view('pages.dasboard.struktur', compact('ketua', 'sekretaris', 'anggota'));
    }

    public function artikel()
    {
         // Ambil artikel terbaru dengan relasi user (pembuat artikel)
    $artikels = Artikel::with('user')
    ->orderBy('created_at', 'desc') // Urutkan berdasarkan artikel terbaru
    ->get();

// Jika tidak ada artikel, beri pesan default
$artikels = $artikels->isEmpty() ? null : $artikels;

return view('pages.dasboard.artikel', compact('artikels'));
}


}
