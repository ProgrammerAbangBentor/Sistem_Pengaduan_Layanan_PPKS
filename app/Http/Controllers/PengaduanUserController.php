<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Timeline;
use App\Models\Kategori_pengaduan;
use Illuminate\Http\Request;


class PengaduanUserController extends Controller
{
    public function index(Request $request)
    {
        $user_id = auth()->id();

        $kategori = Kategori_pengaduan::all();

        $pengaduan = Pengaduan::where('user_id', $user_id)
            ->with('kategori_pengaduan')
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
        $pengaduan = Pengaduan::where('user_id', auth()->id())
            ->where('id', $id)
            ->with(['timelines', 'user'])
            ->firstOrFail();

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
            'pelapor' => 'required',
            'kategori_pelapor' => 'required',
            'jenis_identitas' => 'nullable',
            'no_identitas' => 'nullable|string',
            'kategori_pengaduan_id' => 'required|exists:kategori_pengaduan,id',
            'tanggal_peristiwa' => 'required|date',
            'kronologi_peristiwa' => 'required|string',
            'lokasi_kejadian' => 'nullable|string',
            'nama_tersangka' => 'nullable|string',
            'status_tersangka' => 'nullable|string',
            'no_telfon_tersangka' => 'nullable|string',
            'bukti_identitas' => 'nullable|file|mimes:jpeg,png,pdf',
            'file_bukti' => 'nullable|file|mimes:jpeg,png,pdf',
        ]);

            $pengaduan = new Pengaduan($validate);
            $pengaduan->user_id = auth()->id();
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
        return redirect()->route('pengaduanuser.index')->with('success', 'Pengaduan berhasil dibuat.');
    }
}