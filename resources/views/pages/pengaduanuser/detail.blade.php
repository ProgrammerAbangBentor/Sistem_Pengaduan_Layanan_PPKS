@extends('layouts.app')

@section('title', 'Detail Pengaduan')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Detail Pengaduan</h1>
            </div>

            <div class="section-body">
                <div class="card mt-3">
                    <div class="card-header">
                        <h3>Nomor pengaduan : {{ $pengaduan->nomor_pengaduan }} | Status: {{ $pengaduan->status }} </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                @include('layouts.alert')
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h5>Identitas Pelapor</h5>
                                <table class="table table-striped table-hover table-bordered table-info">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Pelapor</th>
                                            <td>{{ $pengaduan->pelapor == 'Anonim' ? 'Anonim' : $pengaduan->pelapor }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Laporan </th>
                                            <td>{{ \Carbon\Carbon::parse($pengaduan->created_at)->format('d F Y') }}</td>
                                        </tr>
                                        <tr>
                                            <th>Jenis Identitas</th>
                                            <td>{{ $pengaduan->jenis_identitas }}</td>
                                        </tr>
                                        <tr>
                                            <th>No Identitas</th>
                                            <td>{{ $pengaduan->no_identitas }}</td>
                                        </tr>
                                        <tr>
                                            <th>Ketegori Pelapor</th>
                                            <td>{{ $pengaduan->kategori_pelapor }}</td>
                                        </tr>
                                        <tr>
                                            <th>Bukti Identitas</th>
                                            <td>
                                                @if($pengaduan->bukti_identitas)
                                                    @php
                                                        $extension = pathinfo($pengaduan->bukti_identitas, PATHINFO_EXTENSION);
                                                        $fileName = basename($pengaduan->bukti_identitas);
                                                    @endphp

                                                    @if(in_array($extension, ['jpg', 'jpeg', 'png', 'gif']))
                                                        <img src="{{ asset('storage/' . $pengaduan->bukti_identitas) }}" alt="Gambar Pengaduan" class="img-fluid mb-3" style="max-width: 100%; height: auto; object-fit: contain;">
                                                    @elseif(in_array($extension, ['pdf', 'doc', 'docx', 'xls', 'xlsx']))
                                                        <a href="{{ asset('storage/' . $pengaduan->bukti_identitas) }}" target="_blank" class="btn btn-primary">Unduh File</a>
                                                    @endif
                                                @else
                                                    <p>No file submitted.</p>
                                                @endif
                                            </td>
                                        </tr>
                                    </thead>
                                </table>

                                <h5>Identitas Tersangka</h5>
                                <table class="table table-striped table-hover table-bordered table-purple">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Nama Tersangka</th>
                                            <td>{{ $pengaduan->nama_tersangka }}</td>
                                        </tr>
                                        <tr>
                                            <th>Status Tersangka</th>
                                            <td>{{ $pengaduan->status_tersangka }}</td>
                                        </tr>
                                        <tr>
                                            <th>No Telfon Tersangka</th>
                                            <td>{{ $pengaduan->no_telfon_tersangka }}</td>
                                        </tr>
                                    </thead>
                                </table>

                                <h5>Peristiwa</h5>
                                <table class="table table-striped table-hover table-bordered table-success">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Kategori</th>
                                            <td>{{ $pengaduan->kategori_pengaduan->name ?? 'Tidak tersedia' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Peristiwa</th>
                                            <td>{{ \Carbon\Carbon::parse($pengaduan->tanggal_peristiwa)->format('d F Y') }}</td>
                                        </tr>
                                        <tr>
                                            <th>Lokasi Peristiwa</th>
                                            <td>{{ $pengaduan->lokasi_kejadian }}</td>
                                        </tr>
                                        <tr>
                                            <th>Bukti File Peristiwa</th>
                                            <td>
                                                @if($pengaduan->file_bukti)
                                                    @php
                                                        $extension = pathinfo($pengaduan->file_bukti, PATHINFO_EXTENSION);
                                                        $fileName = basename($pengaduan->file_bukti);
                                                    @endphp

                                                    @if(in_array($extension, ['jpg', 'jpeg', 'png', 'gif']))
                                                        <img src="{{ asset('storage/' . $pengaduan->file_bukti) }}" alt="Gambar Pengaduan" class="img-fluid mb-3" style="max-width: 100%; height: auto; object-fit: contain;">
                                                    @elseif(in_array($extension, ['pdf', 'doc', 'docx', 'xls', 'xlsx']))
                                                        <a href="{{ asset('storage/' . $pengaduan->file_bukti) }}" target="_blank" class="btn btn-primary">Unduh File</a>
                                                    @endif
                                                @else
                                                    <p>No file submitted.</p>
                                                @endif
                                            </td>
                                        </tr>
                                    </thead>
                                </table>

                                <div class="card-footer">
                                    <a href="{{ route('pengaduanuser.index') }}" class="btn btn-primary">Kembali</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
