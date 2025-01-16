<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Kategori_pengaduan;
use Illuminate\Http\Request;

class PengaduanUserController extends Controller
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

        return view('pages.pengaduanuser.index', compact('pengaduan', 'kategori'));
    }

    public function show($id)
    {
        $pengaduan = Pengaduan::findorfail($id);
        // $pengaduan = Pengaduan::where('user_id', auth()->id())
        //     ->where('id', $id)
        //     ->with('updatedBy') // Memuat relasi updatedBy
        //     ->firstOrFail(); // Menghasilkan 404 jika tidak ditemukan

        return view('pages.pengaduanUser.detail', compact('pengaduan'));
    }


    public function create()
    {
        $categories = Kategori_pengaduan::all(); // Mengambil semua kategori dari database
        return view('pages.pengaduanUser.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'pelapor' => 'required|in:Mahasiswa,Dosen,Anonim',
            'jenis_identitas' => 'required|in:KTM,NIDN',
            'no_identitas' => 'required|string|exists:users,no_identitas',
            'kategori_pengaduan_id' => 'required|exists:kategori_pengaduan,id',
            'tanggal_peristiwa' => 'required|date',
            'kronologi_peristiwa' => 'required|string',
            // 'latitude' => 'required|numeric',
            // 'longitude' => 'required|numeric',
            'file_bukti' => 'nullable|file|mimes:jpg,png,pdf',
            'kategori_pelapor' => 'required|in:Korban,Pelapor/Saksi',
            'nama_tersangka' => 'nullable|string',
            'status_tersangka' => 'nullable|in:Mahasiswa,Dosen,Staff Kampus,Masyarakat Umum,Masyarakat Kampus Lain',
            'no_telfon_tersangka' => 'nullable|string',
        ]);


        $pengaduan = new Pengaduan($validate);
        $pengaduan->nomor_pengaduan = Pengaduan::generateNomorPengaduan();

        if ($request->hasFile('file_bukti')) {
            $pengaduan->file_bukti = $request->file('file_bukti')->store('bukti', 'public');
        }

        $pengaduan->save();
        return redirect()->route('pengaduanuser.index')->with('success', 'Pengaduan berhasil dibuat.');
    }

}
