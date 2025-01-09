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
                <div class="nav nav-fill my-3">
                    <label class="nav-link shadow-sm step0 border ml-2">Step One</label>
                    <label class="nav-link shadow-sm step1 border ml-2">Step Two</label>
                    <label class="nav-link shadow-sm step2 border ml-2">Step Three</label>
                </div>
                <div class="card">
                    <div class="card-body">
                        <form id="pengaduan-form" action="{{ route('pengaduanuser.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <!-- Step 1 -->
                            <div id="step-1" class="step">
                                <h4 class="text-center text-primary font-weight-bold text-shadow">IDENTITAS PELAPOR</h4>
                                <div class="form-group">
                                    <label for="name">Nama</label>
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                                <div class="form-group">
                                    <label for="user">Akun</label>
                                    <select class="form-control" name="user" required>
                                        <option value="Mahasiswa">Mahasiswa</option>
                                        <option value="Dosen">Dosen</option>
                                        <option value="anonim">Anonim</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="jenis_identitas">Jenis Identitas</label>
                                    <select class="form-control" name="jenis_identitas" required>
                                        <option value="">Pilih Jenis Identitas</option>
                                        <option value="KTP">KTP</option>
                                        <option value="KTM">KTM</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="image_identitas">Unggah Identitas</label>
                                    <input type="file" class="form-control" name="image_identitas" required>
                                    <small class="form-text text-muted">
                                        Supported file types: jpeg, png, jpg. Maksimal ukuran file: 5MB.
                                    </small>
                                    @error('image_identitas')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <textarea class="form-control" name="alamat" rows="2" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="no_tlp">No Telepon</label>
                                    <input type="text" class="form-control" name="no_tlp" required>
                                </div>
                                <button type="button" class="btn btn-primary float-right" onclick="nextStep(2)">Next</button>
                            </div>

                            <!-- Step 2 -->
                            <div id="step-2" class="step d-none">
                                <h4 class="text-center text-primary font-weight-bold text-shadow">IDENTITAS TERLAPOR</h4>
                                <div class="form-group">
                                    <label for="nama_terlapor">Nama Lengkap Terlapor</label>
                                    <input type="text" class="form-control" name="nama_terlapor" required>
                                </div>
                                <div class="form-group">
                                    <label for="status_terlapor">Status Terlapor</label>
                                    <select class="form-control" name="status_terlapor" required>
                                        <option value="Mahasiswa">Mahasiswa</option>
                                        <option value="Dosen">Dosen</option>
                                        <option value="anonim">Anonim</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="no_hp_pelapor">No HP Pelapor</label>
                                    <input type="text" class="form-control" name="no_hp_pelapor" required>
                                </div>
                                <button type="button" class="btn btn-secondary" onclick="prevStep(1)">Back</button>
                                <button type="button" class="btn btn-primary float-right" onclick="nextStep(3)">Next</button>
                            </div>

                            <!-- Step 3 -->
                            <div id="step-3" class="step d-none">
                                <h4 class="text-center text-primary font-weight-bold text-shadow">PERISTIWA</h4>
                                <div class="form-group">
                                    <label for="laporan">Laporan</label>
                                    <textarea class="form-control" name="laporan" rows="5" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="category_id">Kategori</label>
                                    <select class="form-control" name="category_id" required>
                                        <option value="">Pilih Kategori</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tanggal_peristiwa">Tanggal Peristiwa</label>
                                    <input type="date" class="form-control" name="tanggal_peristiwa" required>
                                </div>
                                <div class="form-group">
                                    <label for="lokasi_peristiwa">Lokasi Peristiwa</label>
                                    <textarea class="form-control" name="lokasi_peristiwa" rows="2" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="file">File</label>
                                    <input type="file" class="form-control" name="file">
                                    <small class="form-text text-muted">
                                        Supported file types: jpeg, png, jpg, gif, mp3, mp4, avi, pdf, doc, docx. Maksimal ukuran file: 100MB.
                                    </small>
                                    @error('file')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="button" class="btn btn-secondary" onclick="prevStep(2)">Back</button>
                                <button type="submit" class="btn btn-primary float-right">Kirim Laporan</button>
                            </div>
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
            document.getElementById(`step-${step}`).classList.remove('d-none');
            document.querySelectorAll('.nav-link').forEach((el) => el.classList.remove('bg-primary', 'text-white'));
            document.querySelector(`.step${step - 1}`).classList.add('bg-primary', 'text-white');
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
