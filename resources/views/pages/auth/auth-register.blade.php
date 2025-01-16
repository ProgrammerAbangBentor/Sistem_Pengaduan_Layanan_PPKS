@extends('layouts.auth')

@section('title', 'Register Poltekgo')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')

    <div class="card card-purple">
        <div class="card-header">
            <h4>Registrasi</h4>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    @include('layouts.alert')
                </div>
            </div>


        <div class="card-body">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Input for Name -->
                <div class="form-group">
                    <label for="no_identitas">No Identitas</label>
                    <input id="no_identitas" type="text"
                        class="form-control @error('no_identitas') is-invalid @enderror"
                        name="no_identitas" placeholder="Masukan NIM atau NIDN Anda" value="{{ old('no_identitas') }}" required autofocus>
                    @error('no_identitas')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Input for Email -->
                <div class="form-group">
                    <label for="email">Email Aktif</label>
                    <input id="email" type="email"
                        class="form-control @error('email') is-invalid @enderror"
                        name="email" placeholder="Masukan Email Aktif Anda" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="form-group">
                    <button type="submit" class="btn btn-purple btn-lg btn-block">
                        Buat Akun
                    </button>
                </div>
            </form>
        </div>
    </div>

    @if (session('success'))
        <script>
            $(document).ready(function() {
                var successModal = new bootstrap.Modal(document.getElementById('successModal'));
                successModal.show();
            });
        </script>
    @endif
@endsection


@push('scripts')
    <!-- modal JS Libraries -->
    <script>
        @if (session('success'))
            $(document).ready(function() {
                var successModal = new bootstrap.Modal(document.getElementById('successModal'));
                successModal.show();
            });
        @endif
    </script>
    <!-- JS Libraries -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('library/jquery.pwstrength/jquery.pwstrength.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/auth-register.js') }}"></script>
@endpush
