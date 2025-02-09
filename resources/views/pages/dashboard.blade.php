@extends('layouts.app')

@section('title', 'General Dashboard')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Dashboard - PPKS</h1>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-4">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Users</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalUser }} <!-- Menampilkan jumlah total user -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-4">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="far fa-file"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Complaints</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalPengaduan }} <!-- Menampilkan jumlah total pengaduan -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-4">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="far fa-file"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Sexual Category</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalKategori }} <!-- Menampilkan jumlah total pengaduan -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-4">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="far fa-file"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Article</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalArtikel }} <!-- Menampilkan jumlah total pengaduan -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8 col-md-12 col-12 col-sm-12 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h4>Statistics - Daily Complaints</h4>
                        </div>
                        <div class="card-body">
                            {!! $chart->container() !!}
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-12 col-12 col-sm-12 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h4>Reports by User</h4>
                        </div>
                        <div class="card-body">
                            {!! $chart_pie->container() !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraries -->
    <script src="{{ asset('library/simpleweather/jquery.simpleWeather.min.js') }}"></script>
    <script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('library/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/index-0.js') }}"></script>

      {!! $chart->script() !!}
      {!! $chart_pie->script() !!}
@endpush
