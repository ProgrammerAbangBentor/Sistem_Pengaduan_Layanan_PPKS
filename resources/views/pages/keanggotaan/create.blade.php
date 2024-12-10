@extends('layouts.app')

@section('title', 'Create Anggota')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

<style>
    .image-preview {
        width: 200px; /* Lebar gambar */
        height: 200px; /* Tinggi gambar */
        border: 2px dashed #ccc;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        position: relative;
        border-radius: 10px; /* Opsional: Buat gambar berbentuk lingkaran */
        background-color: #f8f9fa;
    }

    .image-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover; /* Menjaga gambar agar sesuai tanpa melar */
    }
    </style>

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Create Anggota</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="">Anggota</a></div>
                    <div class="breadcrumb-item active">Create Anggota</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Add a New Anggota</h2>
                <p class="section-lead">
                    Fill in the form below to create a new Anggota.
                </p>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Anggota Form</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('anggota.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Nama</label>
                                        <input type="text" class="form-control" name="name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="jabatan">Jabatan</label>
                                        <input type="text" class="form-control" name="jabatan" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <input type="text" class="form-control" name="status" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="no_telp">No Telp</label>
                                        <input type="text" class="form-control" name="no_telp" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="image">Image</label>
                                        <input type="file" class="form-control" name="image" id="image" onchange="previewImage(event)">
                                    </div>
                                    <div class="form-group mt-3">
                                        <label>Preview</label>
                                        <div class="image-preview" id="image-preview"></div>
                                    </div>


                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Save Anggota</button>
                                        <a href="{{ route('anggota.index') }}" class="btn btn-secondary">Kembali</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>
@endsection
<script>
    function previewImage(event) {
        const imagePreview = document.getElementById('image-preview');
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.innerHTML = `<img src="${e.target.result}" alt="Preview Image">`;
            };
            reader.readAsDataURL(file);
        } else {
            imagePreview.innerHTML = ''; // Kosongkan jika tidak ada file
        }
    }
    </script>

@push('scripts')
    <!-- JS Libraries -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
@endpush
