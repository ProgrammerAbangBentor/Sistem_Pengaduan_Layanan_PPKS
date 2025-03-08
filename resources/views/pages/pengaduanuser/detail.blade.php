@extends('layouts.app')

@section('title', 'Detail Pengaduan - Pengguna')

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
                                <h5>Bukti File Peristiwa</h5>
                                    @if($pengaduan->file_bukti)
                                                        @php
                                                            $extension = pathinfo($pengaduan->file_bukti, PATHINFO_EXTENSION);
                                                            $fileName = basename($pengaduan->file_bukti);
                                                        @endphp

                                                        @if(in_array($extension, ['jpg', 'jpeg', 'png', 'gif']))
                                                            <img src="{{ asset('storage/' . $pengaduan->file_bukti) }}" alt="Gambar Pengaduan" class="img-fluid mb-3" style="max-width: 100%; height: auto; object-fit: contain;">
                                                        @elseif(in_array($extension, ['pdf', 'doc', 'docx', 'xls', 'xlsx']))
                                                            <a href="{{ asset('storage/' . $pengaduan->file_bukti) }}" target="_blank" class="btn btn-primary">Unduh File</a>
                                                        @elseif(in_array($extension, ['mp3', 'wav']))
                                                            <audio controls>
                                                                <source src="{{ asset('storage/' . $pengaduan->file_bukti) }}" type="audio/{{ $extension }}">
                                                                Your browser does not support the audio tag.
                                                            </audio>
                                                        @elseif(in_array($extension, ['mp4', 'avi', 'mov', 'mkv', 'flv']))
                                                            <video controls class="img-fluid mb-3" style="max-width: 100%; height: auto; object-fit: contain;">
                                                                <source src="{{ asset('storage/' . $pengaduan->file_bukti) }}" type="video/{{ $extension }}">
                                                                Your browser does not support the video tag.
                                                            </video>
                                                        @endif
                                                    @else
                                                    <p>Tidak ada bukti yang diunggah.</p>
                                                    @endif
                            </div>

                            <div class="col-md-6">
                                <h5>Informasi Pengaduan</h5>
                                <table class="table table-striped table-hover table-bordered">
                                    <tbody>
                                        <tr>
                                            <th>Nomor Pengaduan</th>
                                            <td>{{ $pengaduan->nomor_pengaduan }}</td>
                                        <tr>
                                            <th>Status</th>
                                            <td>{{ $pengaduan->status }}</td>
                                        </tr>

                                        <tr>
                                            <th>Keterangan Perubahan Status</th>
                                                <td>
                                                    @if ($pengaduan->timelines->isNotEmpty())
                                                        @foreach ($pengaduan->timelines as $timeline)
                                                            <p>{{ $timeline->catatan }}</p>
                                                        @endforeach
                                                    @else
                                                        <p><i>Tidak ada catatan untuk status ini.</i></p>
                                                    @endif
                                                </td>
                                        </tr>
                                        @if($pengaduan->status === 'Sedang Diselidiki')
                                            <tr>
                                                <th>Satgas yang Menangani</th>
                                                <td>
                                                    {{ $pengaduan->keanggotaan->name ?? 'Belum ada Satgas yang ditugaskan' }}
                                                </td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <th>Dibuat Oleh</th>
                                            <td>{{ optional($pengaduan->user)->name ?? 'Tidak diketahui' }}</td>
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
        border: 1px solid #dee2e6;
        border-radius: 5px;
        overflow: hidden;
        background-color: #ffffff;
    }

    .table th {
        background-color: #f1f3f5;
        color: #212529;
        font-weight: bold;
        text-align: left;
        padding: 12px;
    }

    .table td {
        padding: 10px;
        vertical-align: middle;
        color: #495057;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f8f9fa;
    }

    /* Kartu */
    .card {
        border: 1px solid #dee2e6;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        background-color: #007bff;
        color: #ffffff;
        font-size: 1.2em;
        font-weight: bold;
        padding: 15px;
    }

    .card-body {
        padding: 20px;
    }

    .card-footer {
        background-color: #f8f9fa;
        border-top: 1px solid #dee2e6;
        padding: 15px;
    }

    /* Gambar */
    .img-fluid {
        max-width: 100%;
        height: auto;
        border-radius: 5px;
        border: 1px solid #dee2e6;
    }

    /* Badge Status */
    .badge {
        font-size: 1em;
        padding: 0.5em 0.8em;
        border-radius: 15px;
    }

    .bg-danger { background-color: #e74c3c !important; }
    .bg-info { background-color: #3498db !important; }
    .bg-success { background-color: #2ecc71 !important; }

    /* Responsivitas */
    @media (max-width: 768px) {
        .card-body { padding: 15px; }
        .table th, .table td { font-size: 0.9em; }
        .img-fluid { max-height: 200px; }
    }
</style>
@endpush
