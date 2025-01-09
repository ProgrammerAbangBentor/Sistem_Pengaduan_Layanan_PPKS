@extends('layouts.app')

@section('title', 'Detail Pengaduan-Pengguna')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Detail Pengaduan</h1>
            </div>
            <div class="section-body">
                <div class="card mt-3">
                    <div class="card-header">
                        <h4>Detail Pengaduan</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Bukti File</h5>
                                @if($pengaduan->file)
                                @php
                                    $extension = pathinfo($pengaduan->file, PATHINFO_EXTENSION);
                                @endphp

                                @if(in_array($extension, ['jpg', 'jpeg', 'png', 'gif']))
                                    <img src="{{ asset($pengaduan->file) }}" alt="Gambar Pengaduan" class="img-fluid mb-3" style="max-height: 300px; object-fit: cover;">
                                @elseif(in_array($extension, ['pdf', 'doc', 'docx', 'xls', 'xlsx']))
                                    <a href="{{ asset($pengaduan->file) }}" target="_blank" class="btn btn-primary">Unduh File</a>
                                @elseif(in_array($extension, ['mp3', 'wav']))
                                    <audio controls>
                                        <source src="{{ asset($pengaduan->file) }}" type="audio/{{ $extension }}">
                                        Your browser does not support the audio tag.
                                    </audio>
                                @elseif(in_array($extension, ['mp4', 'avi', 'mov']))
                                    <video controls style="max-width: 100%; max-height: 300px;">
                                        <source src="{{ asset($pengaduan->file) }}" type="video/{{ $extension }}">
                                        Your browser does not support the video tag.
                                    </video>
                                @else
                                    <p>File ini tidak dapat ditampilkan.</p>
                                @endif
                            @else
                                <p>Tidak ada file yang diunggah.</p>
                            @endif

                            </div>
                            <div class="col-md-6">
                                <h5>Informasi Pengaduan</h5>
                                <table class="table table-striped table-hover table-bordered">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Nama</th>
                                            <td>{{ $pengaduan->name }}</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>Status</th>
                                            <td>
                                                <span class="badge
                                                    @if($pengaduan->status == 'pending') bg-danger
                                                    @elseif($pengaduan->status == 'proses') bg-info
                                                    @elseif($pengaduan->status == 'selesai') bg-success
                                                    @endif text-white">
                                                    {{ ucfirst($pengaduan->status) }}
                                                </span>
                                            </td>
                                        </tr>
                                        <p><strong>Status Terakhir Diubah Oleh:</strong>
                                            {{ $pengaduan->updatedBy ? $pengaduan->updatedBy->name : 'Tidak diketahui' }}
                                        </p>
                                          <tr>
                                            <th>Keterangan Perubahan Status</th>
                                            <td>{{ $pengaduan->status_keterangan ?? 'Tidak ada keterangan' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Laporan</th>
                                            <td>{{ $pengaduan->laporan }}</td>
                                        </tr>
                                        <tr>
                                            <th>Dibuat Oleh</th>
                                            <td>{{ $pengaduan->user }}</td>
                                        </tr>
                                        <tr>
                                            <th>Dibuat pada</th>
                                            <td>{{ $pengaduan->created_at->format('d M Y H:i') }}</td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('pengaduanuser.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('style')
<style>
    /* Tabel */
    .table {
        border: 1px solid #dee2e6; /* Warna border tabel yang lembut */
        border-radius: 5px; /* Sudut melengkung */
        overflow: hidden;
        background-color: #ffffff; /* Warna latar belakang tabel */
    }

    .table th {
        background-color: #f1f3f5; /* Warna header tabel yang lebih lembut */
        color: #212529; /* Warna teks header */
        font-weight: bold;
        text-align: left; /* Teks rata kiri */
        padding: 12px; /* Padding untuk ruang ekstra */
    }

    .table td {
        padding: 10px; /* Padding untuk konten */
        vertical-align: middle; /* Konten rata tengah secara vertikal */
        color: #495057; /* Warna teks */
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f8f9fa; /* Warna striping */
    }

    /* Kartu */
    .card {
        border: 1px solid #dee2e6; /* Warna border */
        border-radius: 8px; /* Sudut melengkung */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Shadow lembut */
    }

    .card-header {
        background-color: #007bff; /* Warna biru untuk header */
        color: #ffffff; /* Teks putih untuk header */
        font-size: 1.2em; /* Ukuran teks */
        font-weight: bold;
        padding: 15px; /* Padding header */
    }

    .card-body {
        padding: 20px; /* Padding body */
    }

    .card-footer {
        background-color: #f8f9fa; /* Latar belakang footer */
        border-top: 1px solid #dee2e6;
        padding: 15px; /* Padding footer */
    }

    /* Gambar */
    .img-fluid {
        max-width: 100%; /* Gambar tidak melebihi lebar kolom */
        height: auto; /* Pertahankan rasio aspek */
        border-radius: 5px; /* Sudut melengkung gambar */
        border: 1px solid #dee2e6; /* Border lembut */
    }

    /* Badge Status */
    .badge {
        font-size: 1em; /* Ukuran teks badge */
        padding: 0.5em 0.8em; /* Padding untuk badge */
        border-radius: 15px; /* Membulatkan badge */
    }

    .bg-danger {
        background-color: #e74c3c !important; /* Warna merah terang */
    }

    .bg-info {
        background-color: #3498db !important; /* Warna biru terang */
    }

    .bg-success {
        background-color: #2ecc71 !important; /* Warna hijau terang */
    }

    /* Responsivitas */
    @media (max-width: 768px) {
        .card-body {
            padding: 15px;
        }

        .table th, .table td {
            font-size: 0.9em; /* Ukuran font lebih kecil di perangkat kecil */
        }

        .img-fluid {
            max-height: 200px; /* Batas tinggi gambar di perangkat kecil */
        }
    }
</style>
@endpush

