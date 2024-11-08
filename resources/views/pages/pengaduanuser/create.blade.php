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
                        <form action="{{ route('pengaduanuser.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
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
                                    <!-- Tambahkan opsi lain sesuai kebutuhan -->
                                </select>
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
                                <label for="laporan">Laporan</label>
                                <textarea class="form-control" name="laporan" rows="5" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="image">File (Gambar, Dokumen, dll.)</label>
                                <input type="file" class="form-control" name="file" accept="*">
                            </div>
                            <button type="submit" class="btn btn-primary">Kirim Laporan</button>

                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
