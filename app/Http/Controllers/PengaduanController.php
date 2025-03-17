<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Kategori_pengaduan;
use App\Models\Keanggotaan;
use Illuminate\Http\Request;
use App\Models\Timeline;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

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
                WHEN status = 'Laporan Diterima' THEN 1
                WHEN status = 'Sedang diverifikasi' THEN 2
                WHEN status = 'Sedang Diselidiki' THEN 3
                WHEN status = 'Dalam Proses Hukum' THEN 4
                WHEN status = 'Kasus Selesai' THEN 5
                ELSE 6
                END")
                ->paginate(10);

        return view('pages.pengaduan.index', compact('pengaduan','kategori'));
    }
    public function create()
    {
        return view('pages.pengaduan.create');
    }

    public function show($id)
    {
        $satgasList = Keanggotaan::where('jabatan', 'anggota')->get();

        $pengaduan = Pengaduan::with(['timelines' => function ($query) use ($id) {
            $pengaduanStatus = Pengaduan::findOrFail($id)->status;
            $query->where('status', $pengaduanStatus);
        },'keanggotaan'])->findOrFail($id);

        return view('pages.pengaduan.detail', compact('pengaduan','satgasList'));
    }
    public function update(Request $request, $id)
    {
        // Validasi input dari request
        $request->validate([
            'status' => 'required|in:Laporan Diterima,Sedang diverifikasi,Sedang Diselidiki,Dalam Proses Hukum,Kasus Selesai',
            'catatan' => 'nullable|string|max:255',
            'satgas_id' => 'nullable|exists:keanggotaans,id',
        ]);
    
        $pengaduan = Pengaduan::findOrFail($id);
    
        // Debugging: Cek data request yang diterima
        Log::info("Request Data: " . json_encode($request->all()));
    
        // Tentukan apakah status atau satgas_id berubah
        $statusBerubah = $pengaduan->status !== $request->status;
        $satgasBerubah = $request->filled('satgas_id') && $pengaduan->satgas_id !== $request->satgas_id;
    
        // Proses jika ada perubahan pada status atau satgas_id
        if ($statusBerubah || $satgasBerubah) {
            // Perbarui status jika berubah
            $pengaduan->status = $request->status;
    
            // Perbarui satgas_id jika ada perubahan
            if ($request->filled('satgas_id')) {
                $pengaduan->satgas_id = $request->satgas_id;
            }
    
            // Simpan perubahan ke database
            $pengaduan->save();
    
            // Jika ada catatan, buat timeline baru
            if ($request->has('catatan')) {
                // Hapus timeline yang lama
                $deletedRows = Timeline::where('pengaduan_id', $pengaduan->id)->delete();
                Log::info("Timeline deleted: $deletedRows rows");
    
                // Buat timeline baru
                $timeline = Timeline::create([
                    'pengaduan_id' => $pengaduan->id,
                    'status' => $pengaduan->status,
                    'catatan' => $request->catatan,
                    'satgas_id' => $request->satgas_id ?? $pengaduan->satgas_id,
                    'created_at' => now()->toDateTimeString(),
                ]);
    
                Log::info("Timeline baru dibuat: " . json_encode($timeline));
            }
    
            // Redirect dengan pesan sukses
            return redirect()->back()->with('success', 'Status dan catatan berhasil diperbarui.');
        }
    
        // Jika tidak ada perubahan
        return redirect()->back()->with('info', 'Tidak ada perubahan status atau satgas_id.');
    }
    


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
