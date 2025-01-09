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
            })
            ->orderByRaw("CASE
                WHEN status = 'pending' THEN 1
                WHEN status = 'proses' THEN 2
                WHEN status = 'selesai' THEN 3
                ELSE 4
            END")
            ->paginate(10);

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
        $request->validate([
            'name' => 'required|string|max:255',
            'user' => 'required|in:Mahasiswa,Dosen,anonim',
            'laporan' => 'required|string',
            'file' => 'nullable|mimes:jpeg,png,jpg,gif,mp3,mp4,avi,pdf,doc,docx|max:100240', // Validasi berbagai jenis file
        ]);

        $userId = auth()->id();
        if (!$userId) {
            return redirect()->back()->with('error', 'Anda harus login untuk membuat pengaduan.');
        }

        $filePath = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = 'assets/files/pengaduan/' . $fileName;

            // Simpan file di folder 'public/assets/files/pengaduan'
            $file->move(public_path('assets/files/pengaduan'), $fileName);
        }

        Pengaduan::create([
            'name' => $request->name,
            'user' => $request->user,
            'laporan' => $request->laporan,
            'file' => $filePath,
            'user_id' => $userId,
        ]);

        return redirect()->route('pengaduan.index')->with('success', 'Pengaduan created successfully');
    }

    public function show($id)
    {
       $pengaduan = Pengaduan::with('user')->findOrFail($id);
        return view('pages.pengaduan.detail', compact('pengaduan'));
    }

    // Mengupdate pengaduan di database
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'laporan' => 'required',
            'status' => 'required|in:pending,proses,selesai',
            'file' => 'nullable|mimes:jpeg,png,jpg,gif,mp3,mp4,avi,pdf,doc,docx|max:10240', // Validasi berbagai jenis file
        ]);

        $pengaduan = Pengaduan::find($id);
        $pengaduan->name = $request->name;
        $pengaduan->laporan = $request->laporan;
        $pengaduan->user = $request->user;
        $pengaduan->status = $request->status;

        if ($request->hasFile('file')) {
            if ($pengaduan->file) {
                $oldFilePath = public_path($pengaduan->file);
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }

            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/files/pengaduan'), $fileName);
            $pengaduan->file = 'assets/files/pengaduan/' . $fileName;
        }

        $pengaduan->save();

        return redirect()->route('pengaduan.index')->with('success', 'Pengaduan updated successfully');
    }

    // Menghapus pengaduan
    public function destroy($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);

        if ($pengaduan->file) {
            $oldFilePath = public_path($pengaduan->file);
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }
        }

        $pengaduan->delete();
        return redirect()->route('pengaduan.index')->with('success', 'Pengaduan deleted successfully');
    }

    public function updateStatus(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'status' => 'required|string|in:pending,proses,selesai',
            'keterangan' => 'required|string|max:255', // Validasi keterangan
        ]);

        // Cari pengaduan berdasarkan ID
        $pengaduan = Pengaduan::findOrFail($id);

        // Perbarui status, keterangan, dan updated_by
        $pengaduan->status = $request->status;
        $pengaduan->keterangan = $request->keterangan;
        $pengaduan->updated_by = auth()->id(); // Simpan ID pengguna yang mengubah
        $pengaduan->save(); // Simpan perubahan ke database

        // Kembalikan respons JSON
        return response()->json([
            'success' => true,
            'message' => 'Status pengaduan berhasil diperbarui dengan keterangan.',
        ]);
    }


}
