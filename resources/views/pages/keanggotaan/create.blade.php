@extends('layouts.app')

@section('title', 'Create Anggota')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Create Anggota</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('artikel.index') }}">Anggota</a></div>
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
                                        <input type="file" class="form-control" name="image">
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

@push('scripts')
    <!-- JS Libraries -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
@endpush
