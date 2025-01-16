<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Pengaduan;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil total user
        $totalUser = User::where('role', 'user')->count();

        // Ambil total pengaduan yang telah dilaporkan
        $totalPengaduan = Pengaduan::count();

        // Ambil data pengaduan harian
        $dailyReports = Pengaduan::selectRaw('DATE(created_at) as date, count(*) as count')
        ->groupBy('date')
        ->orderBy('date', 'asc')
        ->get();

        // Format Chart Batang untuk pengaduan Harian
        $chart = new Chart;
        $chart->labels($dailyReports->pluck('date')->toArray());
        $chart->dataset('Jumlah Laporan', 'bar', $dailyReports->pluck('count')->toArray())
        ->backgroundColor('rgba(0, 123, 255, 0.6)')
        ->color('rgba(0, 123, 255, 1)');

        // Query untuk menghitung jumlah laporan berdasarkan jenis user
        $userReports = Pengaduan::selectRaw('pelapor, count(*) as count')
        ->groupBy('pelapor')
        ->get();

        // Membuat pie chart berdasarkan jenis user
        $chart_pie = new Chart;
        $chart_pie->labels($userReports->pluck('user')->toArray()); // Labels berdasarkan jenis user
        $chart_pie->dataset('Jumlah Laporan', 'pie', $userReports->pluck('count')->toArray()) // Dataset tipe pie
            ->backgroundColor([
                'rgba(40, 167, 69, 1)',    // Warna untuk Mahasiswa
                'rgba(255, 165, 0, 1)',    // Warna untuk Dosen
                'rgba(255, 0, 0, 1)',      // Warna untuk Anonim
            ])
            ->color([
                'rgba(40, 167, 69, 1)',    // Warna border untuk Mahasiswa
                'rgba(255, 165, 0, 1)',    // Warna border untuk Dosen
                'rgba(255, 0, 0, 1)',      // Warna border untuk Anonim
            ]);

        // Ambil jumlah pengaduan berdasarkan kategori
        $dataMahasiswa = Pengaduan::where('pelapor', 'mahasiswa')->count(); // Menghitung pengaduan dari mahasiswa
        $dataDosen = Pengaduan::where('pelapor', 'dosen')->count(); // Menghitung pengaduan dari dosen
        $dataAnonim = Pengaduan::where('pelapor', 'anonim')->count(); // Menghitung pengaduan dari anonim

        // Kirim data ke view
        return view('pages.dashboard', compact('totalUser', 'totalPengaduan', 'dataMahasiswa', 'dataDosen', 'dataAnonim','chart','chart_pie'));
    }
}
