@extends('layouts.app')

@section('title', 'Keanggotaan')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Management Keanggotaan</h1>
                <div class="section-header-button">
                    <a href="{{ route('anggota.create') }}" class="btn btn-primary">Tambah Keanggotaan</a>
                </div>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Keanggotaan</a></div>
                    <div class="breadcrumb-item">All Keanggotaan</div>
                </div>
            </div>
            <div class="section-body">
                <h2 class="section-title">Keanggotaan</h2>
                <p class="section-lead">
                    You can manage all Artikel, such as editing, deleting, and more.
                </p>
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>All Keanggotaan</h4>
                            </div>
                            <div class="card-body">
                                <div class="float-right">
                                    <form method="GET" action="{{ route('anggota.index') }}">
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
                                            <th>Nama</th>
                                            <th>Jabatan</th>
                                            <th>Status</th>
                                            <th>No Telp</th>
                                            <th>Image</th>
                                            <th>Action</th>
                                        </tr>
                                        @foreach ($anggota as $agt)
                                            <tr>
                                                <th>{{ $loop->iteration }}</th>
                                                <td>{{ $agt->name }}</td>
                                                <td>{{ $agt->jabatan }}</td>
                                                <td>{{ $agt->status }}</td>
                                                <td>{{ $agt->no_telp }}</td>
                                                <td>
                                                    @if ($agt->image)
                                                        <img src="{{ asset('storage/' . $agt->image) }}" alt="anggota Image" width="100">
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-left">
                                                        <a href='{{ route('anggota.edit', $agt->id) }}'
                                                            class="btn btn-sm btn-info btn-icon">
                                                            <i class="fas fa-edit"></i>
                                                            Edit
                                                        </a>

                                                        <form action="{{ route('anggota.destroy', $agt->id) }}" method="POST" class="ml-2">
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
