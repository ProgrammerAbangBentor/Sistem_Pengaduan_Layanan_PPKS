<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Models\Kategori_pengaduan;
use App\Models\Timeline;

class PengaduanController extends Controller
{
    public function store(Request $request)
    {
        $validate = $request->validate([
            'pelapor' => 'required|in:Mahasiswa,Dosen,Anonim,Staff Kampus',
            'jenis_identitas' => 'required|in:KTM,NIDN,KTP',
            'no_identitas' => 'required|string|exists:users,no_identitas',
            'bukti_identitas' => 'nullable|file|mimes:jpg,png,jpeg',
            'kategori_pengaduan_id' => 'required|exists:kategori_pengaduan,id',
            'tanggal_peristiwa' => 'required|date',
            'kronologi_peristiwa' => 'required|string',
            'lokasi_kejadian' => 'nullable|string',
            'file_bukti' => 'nullable|file|mimes:mp3,wav,mov,mp4,avi,mkv,flv,jpg,png,pdf|max:30480',
            'kategori_pelapor' => 'required|in:Korban,Pelapor/Saksi',
            'nama_tersangka' => 'nullable|string',
            'status_tersangka' => 'nullable|in:Mahasiswa,Dosen,Staff Kampus,Masyarakat Umum,Mahasiswa Kampus Lain',
            'no_telfon_tersangka' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
        ]);

        try {
            $pengaduan = new Pengaduan($validate);
            $pengaduan->nomor_pengaduan = Pengaduan::generateNomorPengaduan();

            if ($request->hasFile('file_bukti')) {
                $pengaduan->file_bukti = $request->file('file_bukti')->store('bukti', 'public');
            }

            if ($request->hasFile('bukti_identitas')) {
                $pengaduan->bukti_identitas = $request->file('bukti_identitas')->store('identitas', 'public');
            }

            $pengaduan->save();

            Timeline::create([
                'pengaduan_id' => $pengaduan->id,
                'status' => 'Laporan Diterima',
                'catatan' => null,
                'satgas_id' => null,
                'created_at' => now(),
            ]);

            return response()->json([
                'message' => 'POST request diterima!',
                'data' => $request->all(),
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan pengaduan.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function getKategoriPengaduan()
    {
        $kategoriPengaduan = Kategori_pengaduan::all();
        return response()->json($kategoriPengaduan);
    }
}

