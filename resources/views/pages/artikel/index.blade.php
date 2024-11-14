@extends('layouts.app')

@section('title', 'Artikel')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Management Artikel</h1>
                <div class="section-header-button">
                    <a href="{{ route('article.create') }}" class="btn btn-primary">Tambah Artikel</a>
                </div>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Artikel</a></div>
                    <div class="breadcrumb-item">All Artikel</div>
                </div>
            </div>
            <div class="section-body">
                <h2 class="section-title">Artikel</h2>
                <p class="section-lead">
                    You can manage all Artikel, such as editing, deleting, and more.
                </p>
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>All Artikel</h4>
                            </div>
                            <div class="card-body">
                                <div class="float-right">
                                    <form method="GET" action="{{ route('article.index') }}">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search" name="name">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="clearfix mb-3"></div>

                                <div class="table-responsive">
                                    <table class="table-striped table">
                                        <tr>
                                            <th>No</th>
                                            <th>Title</th>
                                            <th>Content</th>
                                            <th>Image</th>
                                            <th>Action</th>
                                        </tr>
                                        @foreach ($artikels as $art)
                                            <tr>
                                                <th>{{ $loop->iteration }}</th>
                                                <td>{{ $art->title }}</td>
                                                <td>{{ $art->content }}</td>
                                                <td>
                                                    @if ($art->image)
                                                        <img src="{{ asset('storage/' . $art->image) }}" alt="Article Image" width="100">
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-left">
                                                        <a href='{{ route('article.edit', $art->id) }}' class="btn btn-sm btn-info btn-icon" style="margin-right: 10px;">
                                                            <i class="fas fa-edit"></i> Edit
                                                        </a>
                                                        <form action="{{ route('article.destroy', $art->id) }}" method="POST" class="ml-2">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-sm btn-danger btn-icon confirm-delete">
                                                                <i class="fas fa-times"></i> Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                                <div class="float-right">
                                    {{-- {{ $categories->withQueryString()->links() }} --}}
                                </div>
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

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/features-posts.js') }}"></script>

@endpush
