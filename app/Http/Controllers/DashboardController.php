<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Kategori_pengaduan;
use App\Models\User;
use App\Models\Pengaduan;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUser = User::where('role', 'user')->count();

        $totalPengaduan = Pengaduan::count();

        $totalKategori = Kategori_pengaduan::count();
        $totalArtikel = Artikel::count();

        $dailyReports = Pengaduan::selectRaw('DATE(created_at) as date, count(*) as count')
        ->groupBy('date')
        ->orderBy('date', 'asc')
        ->get();

        $chart = new Chart;
        $chart->labels($dailyReports->pluck('date')->toArray());
        $chart->dataset('Jumlah Laporan Harian', 'bar', $dailyReports->pluck('count')->toArray())
        ->backgroundColor('rgba(0, 123, 255, 0.6)')
        ->color('rgba(0, 123, 255, 1)');


        $userReports = Pengaduan::selectRaw('pelapor, COUNT(*) as count')
        ->groupBy('pelapor')
        ->get()
        ->keyBy('pelapor');

        $defaultLabels = ['Mahasiswa', 'Dosen', 'Anonim','Staff Kampus'];

        $data = collect($defaultLabels)->map(function ($label) use ($userReports) {
            return [
                'pelapor' => $label,
                'count' => $userReports[$label]->count ?? 0,
            ];
        });

        $labels = $data->pluck('pelapor')->toArray();
        $dataset = $data->pluck('count')->toArray();

        $chart_pie = new Chart;
        $chart_pie->labels($labels);
        $chart_pie->dataset('Jumlah Laporan', 'pie', $dataset)
        ->backgroundColor([
            'rgba(40, 167, 69, 1)',    // Mahasiswa
            'rgba(255, 165, 0, 1)',    // Dosen
            'rgba(255, 0, 0, 1)',      // Staff Kampus
            'rgb(55, 0, 255)',         // Anonim
        ])
        ->color([
            'rgba(40, 167, 69, 1)',
            'rgba(255, 165, 0, 1)',
            'rgba(255, 0, 0, 1)',
            'rgb(55, 0, 255)',
        ]);

        $dataMahasiswa = Pengaduan::where('pelapor', 'Mahasiswa')->count(); // Menghitung pengaduan dari mahasiswa
        $dataDosen = Pengaduan::where('pelapor', 'Dosen')->count(); // Menghitung pengaduan dari dosen
        $dataAnonim = Pengaduan::where('pelapor', 'Anonim')->count(); // Menghitung pengaduan dari anonim
        $dataAnonim = Pengaduan::where('pelapor', 'Staff Kampus')->count(); // Menghitung pengaduan dari Staff Kampus

        // Kirim data ke view
        return view('pages.dashboard', compact('totalArtikel','totalUser', 'totalPengaduan','totalKategori','dataMahasiswa', 'dataDosen', 'dataAnonim','chart','chart_pie'));
    }
}
