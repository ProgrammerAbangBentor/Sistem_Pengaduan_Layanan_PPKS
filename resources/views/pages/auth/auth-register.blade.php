@extends('layouts.auth')

@section('title', 'Register Poltekgo')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
<div class="card card-purple">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="card-header">
            <h4>Registrasi</h4>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    @include('layouts.alert')
                </div>
            </div>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Input for No Identitas -->
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
                    <label for="email_penerima_akun">Email Penerima Akun Aktif</label>
                    <!-- Tampilkan email_penerima_akun dari user jika ada, dan beri readonly agar tidak bisa diubah -->
                    <input id="email_penerima_akun" type="email"
                        class="form-control @error('email_penerima_akun') is-invalid @enderror"
                        name="email_penerima_akun"
                        value="{{ old('email_penerima_akun') }}" required readonly>
                    @error('email_penerima_akun')
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

    <!-- Custom Script to Auto-fill Email Penerima Akun -->
    <script>
       $(document).ready(function () {
    // Ketika No Identitas diubah
    $('#no_identitas').on('input', function () {
        var noIdentitas = $(this).val();

        // Jika no_identitas ada, lakukan request ke server untuk mengambil email
        if (noIdentitas) {
            $.ajax({
                url: '/get-email-by-no-identitas',  // Endpoint untuk mengambil email berdasarkan no_identitas
                method: 'GET',
                data: { no_identitas: noIdentitas },
                success: function(response) {
                    // Jika email ditemukan, isi email_penerima_akun
                    if (response.email_penerima_akun) {
                        $('#email_penerima_akun').val(response.email_penerima_akun).prop('readonly', true);
                    } else {
                        // Jika email tidak ditemukan, biarkan field kosong dan aktifkan agar bisa diubah
                        $('#email_penerima_akun').val('').prop('readonly', false);
                    }
                },
                error: function(xhr, status, error) {
                    console.log("Error:", error);
                    alert("Terjadi kesalahan. Silakan coba lagi.");
                    $('#email_penerima_akun').val('').prop('readonly', false); // Reset jika terjadi error
                }
            });
        } else {
            // Jika no_identitas kosong, kosongkan email_penerima_akun dan buat editable
            $('#email_penerima_akun').val('').prop('readonly', false);
        }
    });
});

    </script>
@endpush
