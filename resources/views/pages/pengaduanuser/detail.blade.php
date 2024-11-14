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
    .table th, .table td {
        font-size: 1.1em; /* Membuat font lebih besar */
        color: #333; /* Warna teks yang lebih gelap */
    }

    .table {
        border: 2px solid #007bff; /* Mengatur warna dan ketebalan border tabel */
    }

    .table th {
        background-color: #f8f9fa; /* Warna latar belakang untuk header tabel */
        font-weight: bold; /* Membuat teks header lebih tebal */
    }

    .table-bordered {
        border: 2px solid #007bff; /* Mengatur border tabel */
    }

    .table-bordered th, .table-bordered td {
        border: 2px solid #007bff; /* Mengatur border sel tabel */
    }

    /* Menjamin responsivitas gambar */
    .img-fluid {
        max-width: 100%; /* Pastikan gambar tidak melebihi lebar kolom */
        height: auto; /* Pertahankan rasio aspek gambar */
    }
</style>
@endpush
