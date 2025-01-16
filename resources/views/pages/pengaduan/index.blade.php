@extends('layouts.app')

@section('title', 'Pengaduan')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Pengaduan</h1>
                <div class="section-header-button">
                    {{-- <a href="{{ route('pengaduan.create') }}" class="btn btn-primary">Buat Pengaduan</a> --}}
                </div>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Pengaduan</a></div>
                    <div class="breadcrumb-item">All Pengaduan</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">

                    </div>
                </div>
            </div>

                <h2 class="section-title">Pengaduan</h2>
                <p class="section-lead">
                    You can manage all Pengaduan, such as editing, deleting, and more.
                </p>
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>All Pengaduan</h4>
                            </div>
                            <div class="card-body">
                                <div class="float-left">
                                    <form method="GET" action="{{ route('pengaduan.index') }}" id="filterForm" class="form-inline">
                                        <div class="form-group mb-2">
                                            <label for="category" class="mr-2">Pilih Kategori:</label>
                                            <select name="category_id" id="category" class="form-control selectric" onchange="this.form.submit()" style="width: 200px;">
                                                <option value="">Semua Kategori</option>
                                                @foreach($kategori as $category)
                                                    <option value="{{ $category->id }}" {{ request('kategori_pengaduan_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </form>
                                </div>

                                <div class="float-right">
                                    <form method="GET" action="{{ route('pengaduan.index') }}">
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
                                    <a href="{{ route('print') }}" target="_blank" class="btn btn-sm btn-primary btn-icon">
                                        <i class="fas fa-print"></i> Print
                                    </a>

                                    <table class="table-striped table">
                                        <tr>
                                            <th>No</th>
                                            <th>Nomor Pengaduan</th>
                                            <th>Pelapor</th>
                                            <th>Jenis Identitas</th>
                                            <th>No Identitas</th>
                                            <th>Tanggal Peristiwa</th>
                                            <th>Kategori</th>
                                            <th>Status Laporan</th>
                                            <th>Action</th>
                                        </tr>
                                        @foreach ($pengaduan as $pengaduan)
                                            <tr>
                                                <th>{{ $loop->iteration }}</th>
                                                <td>{{ $pengaduan->nomor_pengaduan }}</td>
                                                <td>{{ $pengaduan->pelapor }}</td>
                                                <td>{{ $pengaduan->jenis_identitas }}</td>
                                                <td>{{ $pengaduan->no_identitas }}</td>
                                                <td>{{ $pengaduan->tanggal_peristiwa }}</td>
                                                <td>{{ $pengaduan->kategori_pengaduan->name }}</td>
                                                <td>{{ $pengaduan->status }}</td>

                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <a href='{{ route('pengaduan.show', $pengaduan->id) }}' class="btn btn-sm btn-success btn-icon" style="margin-right: 10px;">
                                                            <i class="fas fa-eye"></i> Detail Pengaduan
                                                        </a>
                                                        {{-- <form action="{{ route('pengaduan.destroy', $pengaduan->id) }}" method="POST" class="ml-2">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-sm btn-danger btn-icon confirm-delete ">
                                                                <i class="fas fa-times"></i> Delete
                                                            </button>
                                                        </form> --}}
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                                {{-- <div class="float-right">
                                    {{ $pengaduan->links() }}
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('style')
<style>
    /* Gaya untuk form inline */
    .form-inline {
        display: flex;
        align-items: center; /* Menyelaraskan label dan dropdown secara vertikal */
    }

    /* Gaya untuk label */
    .form-inline label {
        font-weight: bold;
        margin-right: 5px;
        font-size: 14px;
        color: #333;
    }

    /* Gaya untuk dropdown */
    .selectric {
        border-radius: 4px;
        border: 1px solid #ced4da;
        padding: 0.25rem 0.5rem;
        font-size: 12px;
        width: 180px;
        transition: border-color 0.15s ease-in-out;
    }

    /* Gaya saat dropdown aktif */
    .selectric:focus {
        border-color: #80bdff;
        outline: none;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    /* Gaya untuk button */
    .btn-primary {
        margin-left: 5px;
        padding: 0.25rem 0.5rem;
        font-size: 12px;
    }



</style>

@endpush


@push('scripts')
    <!-- JS Libraries -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/features-posts.js') }}"></script>

    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

    <script>
         function updateStatus(pengaduanId, status) {
            // Konfirmasi sebelum mengupdate status
            if (confirm('Apakah Anda yakin ingin mengubah status pengaduan ini menjadi ' + status + '?')) {
                // Meminta keterangan dari pengguna
                var keterangan = prompt('Masukkan keterangan untuk perubahan status:');
                if (!keterangan || keterangan.trim() === '') {
                    alert('Keterangan diperlukan untuk memperbarui status.');
                    return;
                }

                $.ajax({
                    url: '{{ url('/pengaduan') }}/' + pengaduanId + '/update-status',
                    type: 'POST',
                    data: {
                        status: status,
                        keterangan: keterangan, // Kirim keterangan ke server
                        _token: '{{ csrf_token() }}' // Token CSRF untuk keamanan
                    },
                    success: function(response) {
                        if (response.success) {
                            alert(response.message);
                            location.reload(); // Memuat ulang halaman
                        }
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan saat memperbarui status. Silakan coba lagi.');
                    }
                });
            }
        }
        </script>
@endpush
