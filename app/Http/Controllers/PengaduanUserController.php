<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Category;
use Illuminate\Http\Request;

class PengaduanUserController extends Controller
{
      // Menampilkan daftar pengaduan
      public function index(Request $request)
      {
          $userId = auth()->id(); // Mendapatkan ID pengguna yang sedang login
          // Mengambil pengaduan yang terkait dengan pengguna
          $pengaduans = Pengaduan::where('user_id', $userId)
              ->when($request->input('name'), function ($query, $name) {
                  $query->where('name', 'like', '%' . $name . '%')
                        ->orWhere('laporan', 'like', '%' . $name . '%');
              })
              ->paginate(10); // Menggunakan pagination

          return view('pages.pengaduanUser.index', compact('pengaduans'));
      }

    public function show($id)
    {
        // Memastikan pengguna hanya bisa mengakses pengaduannya sendiri
        $pengaduan = Pengaduan::where('user_id', auth()->id())
            ->where('id', $id)
            ->firstOrFail(); // Menghasilkan 404 jika tidak ditemukan

        return view('pages.pengaduanUser.detail', compact('pengaduan'));
    }

    public function create()
    {
        $categories = Category::all(); // Mengambil semua kategori dari database
        return view('pages.pengaduanUser.create', compact('categories'));;
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'user' => 'required|in:Mahasiswa,Dosen,anonim',
            'laporan' => 'required|string',
            'file' => 'nullable|file|max:2048', // Mengizinkan semua jenis file
            'category_id' => 'required|exists:categories,id', // Validasi kategori
        ]);


            // Ambil user ID
            $userId = auth()->id();
            if (!$userId) {
                return redirect()->back()->with('error', 'Anda harus login untuk membuat pengaduan.');
            }

            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = 'assets/files/pengaduan/' . $fileName;

                // Memindahkan file ke public/assets/files/pengaduan
                if ($file->move(public_path('assets/files/pengaduan'), $fileName)) {
                    // Jika pemindahan berhasil, filePath sudah diisi
                } else {
                    // Pemindahan file gagal
                    return redirect()->back()->with('error', 'Gagal mengupload file.');
                }
            }



        // Buat pengaduan baru
        Pengaduan::create([
            'name' => $request->name,
            'user' => $request->user,
            'laporan' => $request->laporan,
            'file' => $filePath, // Menyimpan path file
            'user_id' => $userId, // Mengisi user_id dengan ID pengguna yang sedang login
            'category_id' =>  $request->category_id, // Mengisi category_id dengan ID pengguna yang sedang login
        ]);

        return redirect()->route('pengaduanuser.index')->with('success', 'Pengaduan created successfully');
    }
}
