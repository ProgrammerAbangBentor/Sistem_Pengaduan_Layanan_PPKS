@extends('layouts.app')

@section('title', 'Detail Pengaduan')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Detail Pengaduan</h1>
            </div>

            <div class="section-body">
                <div class="card mt-3">
                    <div class="card-header">
                        <h3>Nomor pengaduan : {{ $pengaduan->nomor_pengaduan }} | Status: {{ $pengaduan->status }} </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                @include('layouts.alert')
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h5>Identitas Pelapor</h5>
                                <table class="table table-striped table-hover table-bordered table-info">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Nama</th>
                                            <td>{{ $pengaduan->pelapor == 'Anonim' ? 'Anonim' : $pengaduan->pelapor }}</p></td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Laporan </th>
                                            <td>{{ \Carbon\Carbon::parse($pengaduan->created_at)->format('d F Y') }}</p></td>
                                        </tr>
                                        <tr>
                                            <th>Jenis Identitas</th>
                                            <td>{{ $pengaduan->jenis_identitas }}</td>
                                        </tr>
                                        <tr>
                                            <th>No Identitas</th>
                                            <td>{{ $pengaduan->no_identitas }}</td>
                                        </tr>
                                        <tr>
                                            <th>Ketegori Pelapor</th>
                                            <td>{{ $pengaduan->kategori_pelapor }}</td>
                                        </tr>
                                    </thead>
                                </table>

                                <h5>Identitas Tersangka</h5>
                                <table class="table table-striped table-hover table-bordered table-purple">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Nama Tersangka</th>
                                            <td>{{ $pengaduan->nama_tersangka }}</td>
                                        </tr>
                                        <tr>
                                            <th>Status Tersangka</th>
                                            <td>{{ $pengaduan->status_tersangka }}</td>
                                        </tr>
                                        <tr>
                                            <th>No Telfon Tersangka</th>
                                            <td>{{ $pengaduan->no_telfon_tersangka }}</td>
                                        </tr>
                                    </thead>
                                </table>

                                <h5>Peristiwa</h5>
                                <table class="table table-striped table-hover table-bordered table-success">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Kategori</th>
                                            <td>{{ $pengaduan->kategori_pengaduan->name ?? 'Tidak tersedia' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Peristiwa</th>
                                            <td>{{ \Carbon\Carbon::parse($pengaduan->tanggal_peristiwa)->format('d F Y') }}</td>
                                        </tr>
                                        <tr>
                                            <th>Lokasi Peristiwa</th>
                                            <td>{{ $pengaduan->lokasi_peristiwa }}</td>
                                        </tr>
                                        <tr>
                                            <th>Bukti File Peristiwa</th>
                                            <td>
                                                @if($pengaduan->file)
                                                @php
                                                    $extension = pathinfo($pengaduan->file, PATHINFO_EXTENSION);
                                                @endphp

                                                @if(in_array($extension, ['jpg', 'jpeg', 'png', 'gif']))
                                                    <img src="{{ asset($pengaduan->file) }}" alt="Gambar Pengaduan" class="img-fluid mb-3" style="max-width: 100%; height: auto; object-fit: contain;">
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
                                            </td>
                                        </tr>
                                    </thead>
                                </table>
                                <br>
                                <hr style="border: 0; height: 2px; background-color: gray;">
                                <h5>Update Status Laporan</h5>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover table-bordered table-white">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Status Saat ini</th>
                                                    <td>{{ $pengaduan->status ?? 'Tidak tersedia' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Catatan Saat ini</th>
                                                    <td>
                                                        @forelse ($pengaduan->timelines as $timelines)
                                                            {{ $timelines->catatan }}
                                                        @empty
                                                            Tidak ada catatan untuk status ini.
                                                        @endforelse
                                                    </td>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                            </div>
                                    <hr style="border: 0; height: 2px; background-color: gray;">
                                    <form action="{{ route('pengaduan.update', $pengaduan) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover table-bordered table-white">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Update Status Baru</th>
                                                    <td>
                                                        <select name="status" id="status" class="form-control">
                                                            <option value="" disabled selected>-- Pilih Status Baru --</option>
                                                            @if($pengaduan->status == 'Laporan Diterima')
                                                                <option value="Sedang diverifikasi" {{ old('status', $pengaduan->status) == 'Sedang diverifikasi' ? 'selected' : '' }}>Sedang Diverifikasi</option>
                                                            @elseif($pengaduan->status == 'Sedang diverifikasi')
                                                                <option value="Sedang Diselidiki" {{ old('status', $pengaduan->status) == 'Sedang Diselidiki' ? 'selected' : '' }}>Sedang Diselidiki</option>
                                                            @elseif($pengaduan->status == 'Sedang Diselidiki')
                                                                <option value="Dalam Proses Hukum" {{ old('status', $pengaduan->status) == 'Dalam Proses Hukum' ? 'selected' : '' }}>Dalam Proses Hukum</option>
                                                            @elseif($pengaduan->status == 'Dalam Proses Hukum')
                                                                <option value="Kasus Selesai" {{ old('status', $pengaduan->status) == 'Kasus Selesai' ? 'selected' : '' }}>Kasus Selesai</option>
                                                            @endif
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Tambah Catatan Baru</th>
                                                    <td>
                                                        <textarea name="catatan" id="catatan" class="form-control" rows="3" placeholder="Tambahkan catatan terkait pengaduan">{{ old('catatan') }}</textarea>
                                                    </td>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>

                                    <div class="d-flex justify-content-between mt-3">
                                        <button type="submit" class="btn btn-danger">Simpan Updatean Status Laporan</button>
                                    </div>
                                </form>
                                <br>

                                <hr style="border: 0; height: 2px; background-color: gray;">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('pengaduan.index') }}" class="btn btn-primary">Kembali</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('style')
<style>
   /* Mengatur body dan elemen utama untuk memenuhi layar */
.main-content {
    min-height: 100vh; /* Mengatur tinggi minimal konten agar memenuhi layar */
    padding: 20px;
    display: flex;
    flex-direction: column;
}

/* Flexbox untuk memastikan layout responsif */
.section-body {
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    align-items: stretch;
}

/* Card yang memenuhi layar dengan padding */
.card {
    width: 100%;
    max-width: 100%; /* Membuat card memanfaatkan seluruh lebar layar */
    margin-bottom: 30px;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

/* Mengatur padding untuk konten card */
.card-body {
    padding: 20px;
}

/* Styling untuk tabel agar lebih responsif */
.table {
    width: 100%;
    font-size: 1.1em; /* Ukuran font lebih besar untuk kenyamanan membaca */
    border: 1px solid #ddd; /* Menambahkan border pada tabel */
    border-collapse: collapse; /* Menggabungkan border pada tabel */
}

/* Menambahkan border pada setiap sel tabel */
.table th, .table td {
    border: 1px solid #ddd; /* Border ringan pada sel */
    padding: 8px; /* Memberikan jarak pada teks dalam sel */
    text-align: left; /* Menyelaraskan teks ke kiri */
}

/* Gambar responsif untuk bukti file */
.img-fluid {
    width: 100%; /* Pastikan gambar mengambil lebar penuh */
    height: auto; /* Menjaga aspek rasio gambar */
    max-height: 400px; /* Membatasi tinggi gambar untuk menghindari gambar yang terlalu besar */
    object-fit: contain; /* Menghindari pemotongan gambar */
}

/* Menyesuaikan tombol agar lebih besar dan nyaman untuk klik */
.btn {
    font-size: 1.1em;
    padding: 12px 25px;
    border-radius: 50px;
}

/* Membuat footer card tetap terjaga posisinya */
.card-footer {
    background-color: #f8f9fa;
    padding: 15px;
    text-align: right;
    border-radius: 0 0 8px 8px;
    margin-top: 20px;
}

/* Responsivitas untuk tampilan mobile */
@media (max-width: 768px) {
    /* Mengatur padding untuk mobile */
    .card-body {
        padding: 15px;
    }

    .table th, .table td {
        font-size: 1em;
    }

    /* Gambar menyesuaikan ukuran layar */
    .img-fluid {
        max-height: 250px;
        object-fit: contain;
    }

    /* Mengatur ukuran tombol untuk mobile */
    .btn {
        font-size: 1em;
        padding: 10px 20px;
    }
}

/* Warna untuk tabel berdasarkan kategori */
.table-info {
    background-color: #d1ecf1; /* Blue for Identitas Pelapor */
}

.table-purple {
    background-color: #e2d4f4; /* Purple for Identitas Terlapor */
}

.table-success {
    background-color: #d4edda; /* Green for Peristiwa */
}
</style>
@endpush

