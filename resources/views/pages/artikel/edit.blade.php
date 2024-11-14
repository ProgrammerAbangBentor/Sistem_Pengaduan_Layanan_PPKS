@extends('layouts.app')

@section('title', 'Edit Artikel')

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
                <h1>Edit Artikel</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Forms</a></div>
                    <div class="breadcrumb-item">Artikel</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Edit Artikel</h2>

                <div class="card">
                    <form action="{{ route('article.update', $artikel) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-header">
                            <h4>Edit Data Artikel</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Title Artikel</label>
                                <input type="text"
                                       class="form-control @error('title') is-invalid @enderror"
                                       name="title" value="{{ old('title', $artikel->title) }}" required>
                                @error('title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Content Artikel</label>
                                <textarea
                                    class="form-control @error('content') is-invalid @enderror"
                                    name="content" required>{{ old('content', $artikel->content) }}</textarea>
                                @error('content')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Image</label>
                                @if ($artikel->image)
                                    <img src="{{ asset('storage/' . $artikel->image) }}" alt="Article Image" width="100">
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
