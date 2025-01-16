<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Kategori_pengaduan;
use Illuminate\Http\Request;
use App\Models\Timeline;
use Illuminate\Support\Facades\Storage;

class PengaduanController extends Controller
{
    // Menampilkan daftar pengaduan
    public function index(Request $request)
    {
        $kategori = Kategori_pengaduan::all();

        $pengaduan = Pengaduan::with('kategori_pengaduan')
            ->when($request->input('no_identitas'), function ($query, $no_identitas) {
                $query->where('no_identitas', 'like', '%' . $no_identitas . '%');
            })
            ->when($request->input('tanggal_peristiwa'), function ($query, $tanggal_peristiwa) {
                $query->whereDate('tanggal_peristiwa', $tanggal_peristiwa);
            })
            ->when($request->input('kategori_id'), function ($query, $kategori_id) {
                $query->where('kategori_pengaduan_id', $kategori_id);
            })
            ->orderByRaw("CASE
                WHEN status = 'pending' THEN 1
                WHEN status = 'proses' THEN 2
                WHEN status = 'selesai' THEN 3
                ELSE 4
            END")
            ->paginate(10);
            $pengaduan->withQueryString();

        return view('pages.pengaduan.index', compact('pengaduan', 'kategori'));
    }
    public function create()
    {
        return view('pages.pengaduan.create');
    }

    public function show($id)
    {
        $pengaduan = Pengaduan::with(['timelines' => function ($query) use ($id) {
            $pengaduanStatus = Pengaduan::findOrFail($id)->status;
            $query->where('status', $pengaduanStatus);
        }])->findOrFail($id);
        return view('pages.pengaduan.detail', compact('pengaduan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Laporan Diterima,Sedang diverifikasi,Sedang Diselidiki,Dalam Proses Hukum,Kasus Selesai',
            'catatan' => 'nullable|string|max:255',
        ]);
        $pengaduan = Pengaduan::findOrFail($id);



        if ($pengaduan->status != $request->status) {
            $pengaduan->status = $request->status;
            $pengaduan->save();

            if ($request->has('catatan')) {
                Timeline::create([
                    'pengaduan_id' => $pengaduan->id,
                    'status' => $pengaduan->status,
                    'catatan' => $request->catatan,
                    'created_at' => now(),
                ]);
            }

            return redirect()->route('pengaduan.index')->with('success', 'Status dan catatan berhasil diperbarui.');
        }

        return redirect()->back()->with('error', 'Tidak ada perubahan status.');
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


}
