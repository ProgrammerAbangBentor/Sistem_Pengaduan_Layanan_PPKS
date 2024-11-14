<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengaduanController extends Controller
{
    // Menampilkan daftar pengaduan
    public function index(Request $request)
    {
        // Ambil semua kategori
        $categories = Category::all();

        $pengaduans = Pengaduan::query()
            ->join('users', 'pengaduans.user_id', '=', 'users.id')
            ->join('categories', 'pengaduans.category_id', '=', 'categories.id') // Menambahkan join untuk kategori
            ->select('pengaduans.*', 'users.email as user_email', 'categories.name as category_name') // Menyertakan nama kategori
            ->when($request->input('name'), function ($query, $name) {
                $query->where('pengaduans.name', 'like', '%' . $name . '%')
                      ->orWhere('pengaduans.laporan', 'like', '%' . $name . '%');
            })
            ->when($request->input('category_id'), function ($query, $categoryId) {
                $query->where('pengaduans.category_id', $categoryId);
            })
            ->orderByRaw("CASE
                WHEN status = 'pending' THEN 1
                WHEN status = 'proses' THEN 2
                WHEN status = 'selesai' THEN 3
                ELSE 4
            END")
            ->paginate(1);

        return view('pages.pengaduan.index', compact('pengaduans', 'categories'));
    }


    // Menampilkan form untuk membuat pengaduan
    public function create()
    {
        return view('pages.pengaduan.create');
    }

    // Menyimpan pengaduan baru ke database
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'user' => 'required|in:Mahasiswa,Dosen,anonim',
            'laporan' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

        ]);


            // Ambil user ID
            $userId = auth()->id();
            if (!$userId) {
                return redirect()->back()->with('error', 'Anda harus login untuk membuat pengaduan.');
            }

        // Simpan gambar jika ada
        $imagePath = null; // Default jika tidak ada gambar
        if ($request->hasFile('image')) {
            // Mendapatkan file yang di-upload
            $image = $request->file('image');

            // Menentukan nama file dan path penyimpanan
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = 'assets/img/pengaduan/' . $imageName; // Path relatif

            // Memindahkan file ke public/assets/pengaduan
            $image->move(public_path('assets/img/pengaduan'), $imageName);
        }


        // Buat pengaduan baru
        Pengaduan::create([
            'name' => $request->name,
            'user' => $request->user,
            'laporan' => $request->laporan,
            'image' => $imagePath,
            'user_id' => $userId, // Mengisi user_id dengan ID pengguna yang sedang login
        ]);

        return redirect()->route('pengaduan.index')->with('success', 'Pengaduan created successfully');
    }

    // Menampilkan detail pengaduan
    public function show($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        return view('pages.pengaduan.detail', compact('pengaduan'));
    }

    // Menampilkan form edit pengaduan
    public function edit($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        return view('pages.pengaduan.edit', compact('pengaduan'));
    }

    // Mengupdate pengaduan di database
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'laporan' => 'required',
            'status' => 'required|in:pending,proses,selesai',
            'image' => 'nullable|image|max:2048', // Validasi gambar, jika ada

        ]);

        $pengaduan = Pengaduan::find($id);
        $pengaduan->name = $request->name;
        $pengaduan->laporan = $request->laporan;
        $pengaduan->user = $request->user;
        $pengaduan->status = $request->status;

        // Cek jika ada gambar yang diupload
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($pengaduan->image) {
                $oldImagePath = public_path($pengaduan->image); // Path lama gambar
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath); // Menghapus gambar lama
                }
            }

            // Simpan gambar baru
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName(); // Menentukan nama unik untuk gambar
            $image->move(public_path('assets/img'), $imageName); // Pindahkan gambar ke folder yang diinginkan
            $pengaduan->image = 'assets/img/' . $imageName; // Simpan path gambar ke database
        }

        $pengaduan->save();

        return redirect()->route('pengaduan.index')->with('success', 'Pengaduan updated successfully');
    }



    // Menghapus pengaduan
    public function destroy($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);

        // Hapus gambar jika ada
        if ($pengaduan->image) {
            $oldImagePath = public_path($pengaduan->image); // Path lengkap
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath); // Menghapus file
            }
        }

        $pengaduan->delete();
        return redirect()->route('pengaduan.index')->with('success', 'Pengaduan deleted successfully');
    }

    public function updateStatus(Request $request, $id)
    {
        // Validasi input status
        $request->validate([
            'status' => 'required|string|in:pending,proses,selesai',
        ]);

        // Temukan pengaduan berdasarkan ID
        $pengaduan = Pengaduan::findOrFail($id);

        // Update status pengaduan
        $pengaduan->status = $request->status;
        $pengaduan->save();

        // Respons sukses
        return response()->json(['success' => true, 'message' => 'Status pengaduan berhasil diperbarui.']);
    }
}
