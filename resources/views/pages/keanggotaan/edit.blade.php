@extends('layouts.app')

@section('title', 'Edit Keanggotaan')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Keanggotaan</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Forms</a></div>
                    <div class="breadcrumb-item">Keanggotaan</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Edit Keanggotaan</h2>

                <div class="card">
                    <form action="{{ route('anggota.update', $anggota) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-header">
                            <h4>Edit Data Anggota</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text"
                                       class="form-control @error('name') is-invalid @enderror"
                                       name="name" value="{{ old('name', $anggota->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Jabatan</label>
                                <input type="text"
                                       class="form-control @error('jabatan') is-invalid @enderror"
                                       name="jabatan" value="{{ old('jabatan', $anggota->jabatan) }}" required>
                                @error('jabatan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <input type="text"
                                       class="form-control @error('status') is-invalid @enderror"
                                       name="status" value="{{ old('status', $anggota->status) }}" required>
                                @error('status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>No Telp</label>
                                <input type="text"
                                       class="form-control @error('no_telp') is-invalid @enderror"
                                       name="no_telp" value="{{ old('no_telp', $anggota->no_telp) }}" required>
                                @error('no_telp')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Image</label>
                                @if ($anggota->image)
                                    <img src="{{ asset('storage/' . $anggota->image) }}" alt="Anggota Image" width="100">
                                @endif
                                <br>
                                <br>
                                <input type="file" name="image" accept="image/*">
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
@endpush
