@extends('layouts.app')

@section('title', 'Pengaduan-Pengguna')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Pengaduan Saya</h1>
                <div class="section-header-button">
                        <a href="{{ route('pengaduanuser.create') }}" class="btn btn-primary">Buat Pengaduan</a>
                </div>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Pengaduan Saya</a></div>
                    <div class="breadcrumb-item">All Pengaduan Saya</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">

                    </div>
                </div>
                <h2 class="section-title">Pengaduan Saya</h2>

                <p class="section-lead">
                    You can manage all Pengaduan, such as editing, deleting, and more.
                </p>
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">

                                <h4>All Pengaduan Saya</h4>
                            </div>

                            <div class="card-body">
                                <div class="float-left">
                                    <select class="form-control selectric">
                                        <option>Action For Selected</option>
                                        <option>Move to Draft</option>
                                        <option>Move to Pending</option>
                                        <option>Delete Permanently</option>
                                    </select>
                                </div>
                                <div class="float-right">

                                    <form method="GET" action="{{ route('pengaduanuser.index') }}">
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
                                            <th>Judul Laporan</th>
                                            <th>Tanggal</th>
                                            <th>Keterangan Proses Laporan</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                        @foreach($pengaduans as $pengaduan)
                                            <tr>
                                                <th>{{ $loop->iteration }}</th>
                                                <td>{{ $pengaduan->laporan }}</td>
                                                <td>{{ $pengaduan->created_at->format('d-m-Y') }}</td>
                                                <td>{{ $pengaduan->keterangan ?? 'Tidak ada keterangan' }}</td>
                                                <td>
                                                    <span class="badge
                                                        @if($pengaduan->status == 'pending') bg-danger
                                                        @elseif($pengaduan->status == 'proses') bg-info
                                                        @elseif($pengaduan->status == 'selesai') bg-success
                                                        @endif text-white">
                                                        {{ ucfirst($pengaduan->status) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <a href="{{ route('pengaduanuser.show', $pengaduan->id) }}" class="btn btn-info">Lihat</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                                <div class="float-right">
                                    {{ $pengaduans->withQueryString()->links() }}
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
