@extends('layouts.app')

@section('title', 'Create Pengaduan-Pengguna')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Buat Pengaduan</h1>
            </div>
            @include('layouts.alert')
            <div class="section-body">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('pengaduanuser.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Pelapor</label>
                                <div class="selectgroup w-100">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="pelapor" value="Mahasiswa" class="selectgroup-input"
                                            checked="">
                                        <span class="selectgroup-button">Mahasiswa</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="pelapor" value="Dosen" class="selectgroup-input"
                                            checked="">
                                        <span class="selectgroup-button">Dosen</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="pelapor" value="Staff Kampus" class="selectgroup-input"
                                            checked="">
                                        <span class="selectgroup-button">Staff Kampus</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="pelapor" value="Anonim" class="selectgroup-input"
                                            checked="">
                                        <span class="selectgroup-button">Anonim</span>
                                    </label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Kategori Pelapor</label>
                                <div class="selectgroup w-100">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="kategori_pelapor" value="Korban" class="selectgroup-input"
                                            checked="">
                                        <span class="selectgroup-button">Korban</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="kategori_pelapor" value="Pelapor/Saksi" class="selectgroup-input">
                                        <span class="selectgroup-button">Pelapor/Saksi</span>
                                    </label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Jenis Identitas</label>
                                <div class="selectgroup w-100">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="jenis_identitas" value="KTM" class="selectgroup-input"
                                            checked="">
                                        <span class="selectgroup-button">Kartu Tanda Mahasiswa (KTM)</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="jenis_identitas" value="NIDN" class="selectgroup-input">
                                        <span class="selectgroup-button">Nomor Induk Dosen Nasional (NIDN)</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="jenis_identitas" value="KTP" class="selectgroup-input">
                                        <span class="selectgroup-button">Kartu Tanda Kependudukan (KTP)</span>
                                    </label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="no_identitas" class="form-label">Nomor Identitas</label>
                                <input type="text" name="no_identitas" id="no_identitas" class="form-control" value="{{ old('no_identitas') }}">
                            </div>

                            <div class="mb-3">
                                <label for="bukti_identitas" class="form-label">Unggah File Bukti Identitas Anda</label>
                                <input type="file" name="bukti_identitas" id="bukti_identitas" class="form-control">
                                @error('bukti_identitas')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="kategori_pengaduan_id" class="form-label">Kategori Pengaduan</label>
                                <select name="kategori_pengaduan_id" id="kategori_pengaduan_id" class="form-control" required>
                                    <option value="">Pilih Kategori</option>
                                    @foreach(  $categories as $kategori)
                                        <option value="{{ $kategori->id }}" {{ old('kategori_pengaduan_id') == $kategori->id ? 'selected' : '' }}>
                                            {{ $kategori->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('kategori_pengaduan_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="tanggal_peristiwa" class="form-label">Tanggal Peristiwa</label>
                                <input type="date" name="tanggal_peristiwa" id="tanggal_peristiwa" class="form-control" value="{{ old('tanggal_peristiwa') }}" required>
                                @error('tanggal_peristiwa')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="kronologi_peristiwa" class="form-label">Kronologi Peristiwa</label>
                                <textarea name="kronologi_peristiwa" id="kronologi_peristiwa" class="form-control" rows="4" required>{{ old('kronologi_peristiwa') }}</textarea>
                                @error('kronologi_peristiwa')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="lokasi_kejadian" class="form-label">Lokasi Peristiwa</label>
                                <input type="text" name="lokasi_kejadian" id="lokasi_kejadian" class="form-control" value="{{ old('lokasi_kejadian') }}" required>
                                @error('lokasi_kejadian')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="file_bukti" class="form-label">Unggah File Bukti Kekerasan Seksual</label>
                                <input type="file" name="file_bukti" id="file_bukti" class="form-control">
                                @error('file_bukti')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="nama_tersangka" class="form-label">Nama Tersangka (Wajib)</label>
                                <input type="text" name="nama_tersangka" id="nama_tersangka" class="form-control" value="{{ old('nama_tersangka') }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Status Tersangka</label>
                                <div class="selectgroup w-100">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="status_tersangka" value="Mahasiswa" class="selectgroup-input"
                                            checked="">
                                        <span class="selectgroup-button">Mahasiswa</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="status_tersangka" value="Dosen" class="selectgroup-input">
                                        <span class="selectgroup-button">Dosen</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="status_tersangka" value="Staff Kampus" class="selectgroup-input">
                                        <span class="selectgroup-button">Staff Kampus</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="status_tersangka" value="Masyarakat Umum" class="selectgroup-input">
                                        <span class="selectgroup-button">Masyarakat Umum</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="status_tersangka" value="Mahasiswa Kampus Lain" class="selectgroup-input">
                                        <span class="selectgroup-button">Mahasiswa Kampus Lain</span>
                                    </label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="no_telfon_tersangka" class="form-label">Nomor Telepon Tersangka (Wajib)</label>
                                <input type="text" name="no_telfon_tersangka" id="no_telfon_tersangka" class="form-control" value="{{ old('no_telfon_tersangka') }}">
                            </div>

                            <button type="submit" class="btn btn-primary">Simpan Pengaduan</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @push('scripts')
    <script>
        function nextStep(step) {
            document.querySelectorAll('.step').forEach((el) => el.classList.add('d-none'));
            document.getElementById(step-${step}).classList.remove('d-none');
            document.querySelectorAll('.nav-link').forEach((el) => el.classList.remove('bg-primary', 'text-white'));
            document.querySelector(.step${step - 1}).classList.add('bg-primary', 'text-white');
        }

        function prevStep(step) {
            nextStep(step);
        }
    </script>
    @endpush

    @push('style')
    <style>
        .nav-link {
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .step {
            display: none;
        }

        .step:not(.d-none) {
            display: block;
        }

        .text-shadow {
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }

        .bg-primary {
            background-color: #007bff !important;
        }
    </style>
    @endpush
@endsection