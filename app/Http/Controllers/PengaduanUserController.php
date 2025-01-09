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
        $pengaduan = Pengaduan::where('user_id', auth()->id())
            ->where('id', $id)
            ->with('updatedBy') // Memuat relasi updatedBy
            ->firstOrFail(); // Menghasilkan 404 jika tidak ditemukan

        return view('pages.pengaduanUser.detail', compact('pengaduan'));
    }


    public function create()
    {
        $categories = Category::all(); // Mengambil semua kategori dari database
        return view('pages.pengaduanUser.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'user' => 'required|in:Mahasiswa,Dosen,anonim',
            'jenis_identitas' => 'required|in:KTP,KTM',
            'image_identitas' => 'required|image|mimes:jpeg,png,jpg|max:5120',
            'alamat' => 'required|string|max:500',
            'no_tlp' => 'required|string|max:20',
            'nama_terlapor' => 'required|string|max:255',
            'status_terlapor' => 'required|in:Mahasiswa,Dosen,anonim',
            'no_hp_pelapor' => 'required|string|max:20',
            'laporan' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'tanggal_peristiwa' => 'required|date',
            'lokasi_peristiwa' => 'required|string|max:500',
            'file' => 'nullable|file|max:100048', // Mengizinkan semua jenis file
        ]);

        $userId = auth()->id();
        if (!$userId) {
            return redirect()->back()->with('error', 'Anda harus login untuk membuat pengaduan.');
        }

        // Proses upload file identitas
        $imageIdentitasPath = null;
        if ($request->hasFile('image_identitas')) {
            $image = $request->file('image_identitas');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imageIdentitasPath = 'assets/images/identitas/' . $imageName;
            $image->move(public_path('assets/images/identitas'), $imageName);
        }

        // Proses upload file laporan jika ada
        $filePath = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = 'assets/files/pengaduan/' . $fileName;
            $file->move(public_path('assets/files/pengaduan'), $fileName);
        }

        // Buat pengaduan baru
        Pengaduan::create([
            'name' => $request->name,
            'user' => $request->user,
            'jenis_identitas' => $request->jenis_identitas,
            'image_identitas' => $imageIdentitasPath,
            'alamat' => $request->alamat,
            'no_tlp' => $request->no_tlp,
            'nama_terlapor' => $request->nama_terlapor,
            'status_terlapor' => $request->status_terlapor,
            'no_hp_pelapor' => $request->no_hp_pelapor,
            'laporan' => $request->laporan,
            'category_id' => $request->category_id,
            'tanggal_peristiwa' => $request->tanggal_peristiwa,
            'lokasi_peristiwa' => $request->lokasi_peristiwa,
            'file' => $filePath,
            'user_id' => $userId,
        ]);

        return redirect()->route('pengaduanuser.index')->with('success', 'Pengaduan berhasil dibuat.');
    }
}
