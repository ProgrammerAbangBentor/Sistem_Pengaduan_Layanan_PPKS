@extends('layouts.app')

@section('title', 'Create Pengaduan')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Create Pengaduan</h1>
            </div>
            @include('layouts.alert')
            <div class="section-body">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Field Nama -->
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" class="form-control" name="name" required>
                            </div>

                            <!-- Field Akun -->
                            <div class="form-group">
                                <label for="user">Akun</label>
                                <select class="form-control" name="user" required>
                                    <option value="Mahasiswa">Mahasiswa</option>
                                    <option value="Dosen">Dosen</option>
                                    <option value="anonim">Anonim</option>
                                    <!-- Tambahkan opsi lain sesuai kebutuhan -->
                                </select>
                            </div>

                            <!-- Field Laporan -->
                            <div class="form-group">
                                <label for="laporan">Laporan</label>
                                <textarea class="form-control" name="laporan" rows="5" required></textarea>
                            </div>

                            <!-- Field File -->
                            <div class="form-group">
                                <label for="file">File</label>
                                <input type="file" class="form-control" name="file">
                                <small class="form-text text-muted">
                                    Supported file types: image (jpeg, png, jpg, gif), audio (mp3), video (mp4, avi), documents (pdf, doc, docx).
                                    <br>
                                    Maksimal ukuran file: 10MB
                                </small>
                                <!-- Menampilkan pesan error jika ada -->
                                @if ($errors->has('file'))
                                    <div class="alert alert-danger mt-2">
                                        {{ $errors->first('file') }}
                                    </div>
                                @endif
                            </div>

                            <!-- Tombol Submit -->
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="{{ route('home') }}" class="btn btn-secondary">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
