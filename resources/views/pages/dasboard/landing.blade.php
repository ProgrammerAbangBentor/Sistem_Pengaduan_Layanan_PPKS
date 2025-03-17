<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
   <link href="{{ asset ('template/img/logo.png') }}" rel="icon">
    <title>Layanan Pengaduan Dan Penanganan Kekerasan seksual</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset ('templatemo/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{ asset ('templatemo/assets/css/fontawesome.css')}}">
    <link rel="stylesheet" href="{{ asset ('templatemo/assets/css/templatemo-scholar.css')}}">
    <link rel="stylesheet" href="{{ asset ('templatemo/assets/css/owl.css')}}">
    <link rel="stylesheet" href="{{ asset ('templatemo/assets/css/animate.css')}}">
    <link rel="stylesheet"href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
<!--

TemplateMo 586 Scholar

https://templatemo.com/tm-586-scholar

-->
  </head>
<style>

.team-img {
    width: 100%; /* Menyesuaikan dengan kontainer */
    max-width: 200px; /* Maksimum 200px */
    height: auto; /* Menjaga aspek rasio */
    aspect-ratio: 1 / 1; /* Memastikan tetap berbentuk lingkaran */
    object-fit: cover; /* Memastikan gambar tetap proporsional */
    border-radius: 50%; /* Membuat gambar lingkaran */
}


    /* Menghilangkan list bullet dan padding default */
ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

/* Styling untuk item dropdown */
.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-menu {
    display: none;
    position: absolute;
    left: 0;
    top: 100%;
    background-color: #9a1fff;
    min-width: 160px;
    box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
    z-index: 1;
}

.dropdown:hover .dropdown-menu {
    display: block;
}

/* Styling untuk link item dropdown */
.dropdown-menu li {
    padding: 8px 16px;
}

.dropdown-menu a {
    text-decoration: none;
    color: #333;
}

.dropdown-menu a:hover {
    background-color: #5d0171;
}
.small-text {
    font-size: 12px; /* Sesuaikan ukuran font sesuai keinginan */
}
</style>
<body>

  <!-- ***** Preloader Start ***** -->
  <div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
      <span class="dot"></span>
      <div class="dots">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </div>
  <!-- ***** Preloader End ***** -->

  <!-- ***** Header Area Start ***** -->
  <header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                   <!-- ***** Logo Start ***** -->

    <div style="display: flex; align-items: center; gap: 10px;">
        <!-- Logo -->
        <a href="index.html" class="logo" style="display: flex; align-items: center;">
            <img src="{{asset('templatemo/assets/images/logo4.png')}}" style="height: 80px; width: auto;">
        </a>

        <!-- Teks -->
        <div class="search-input">
            <form id="search" action="#" style="margin: 0;">
                <h1 style="font-size: 16px; color: white; margin: 0;">Pelayanan & Penanganan Kekerasan Seksual</h1>
            </form>
        </div>
    </div>
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                      <li class="scroll-to-section"><a href="{{ route('dashboard') }}" class="active">Home</a></li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle">Profile</a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('artikel') }}">Artikel</a></li>
                            <li><a href="{{ route('struktur') }}">Stuktur</a></li>
                            <li><a href="#visimisi">VisiMisi</a></li>

                        </ul>
                    </li>

                      <li class="scroll-to-section"><a href="#services">Services</a></li>
                      
                      <li class="scroll-to-section"><a href="#team">Team</a></li>
                    
                      <li class="scroll-to-section"><a href="#contact">Register Now!</a></li>
                  </ul>
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
  </header>
  <!-- ***** Header Area End ***** -->

<!--Home -->
  <div class="main-banner" id="top">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="owl-carousel owl-banner">
            <div class="item item-1" style="position: relative; padding: 50px; color: white; overflow: hidden;">
                <!-- Latar belakang dengan efek blur -->
                <div style="
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background-image: url('{{asset('templatemo/assets/images/bg1.jpg')}}');
                    background-size: cover;
                    background-position: center;
                    background-repeat: no-repeat;
                    filter: blur(4px);
                    z-index: 1;
                "></div>

                <!-- Konten di atas latar belakang -->
                <div style="position: relative; z-index: 2;">
                    <div class="header-text">
                        <span class="category">Welcome</span>
                        <h2>With This Website, Everything Becomes Easier</h2>
                        <p>Sexual violence treatment service websites are usually platforms designed to provide support, information and services to victims of sexual violence.</p>
                         <div class="buttons">
                            <div class="main-button" >
                                <a href="{{ route('login') }}">Masuk</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="item item-2" style="position: relative; padding: 50px; color: white; overflow: hidden;">
                <!-- Latar belakang dengan efek blur -->
                <div style="
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background-image: url('{{asset('templatemo/assets/images/bg2.jpg')}}');
                    background-size: cover;
                    background-position: center;
                    background-repeat: no-repeat;
                    filter: blur(4px);
                    z-index: 1;
                "></div>

                <!-- Konten di atas latar belakang -->
                <div style="position: relative; z-index: 2;">
                    <div class="header-text">
                        <span class="category">Welcome</span>
                        <h2>With This Website, Everything Becomes Easier</h2>
                        <p>Sexual violence treatment service websites are usually platforms designed to provide support, information and services to victims of sexual violence.</p>
                        <div class="buttons">
                            <div class="main-button">
                                <a href="{{ route('login') }}">Daftar Akun</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<!-- Service -->
  <div class="services section" id="services">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-6">
          <div class="service-item">
            <div class="icon">
              <img src="{{asset('templatemo/assets/images/service-01.png')}}" alt="online degrees">
            </div>
            <div class="main-content">
              <h4>Data Security</h4>
              <p>Efforts to protect sensitive data from unauthorized access, theft, or damage..</p>
              <div class="main-button">
                <a href="#">Read More</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="service-item">
            <div class="icon">
              <img src="{{asset('templatemo/assets/images/service-02.png')}}" alt="short courses">
            </div>
            <div class="main-content">
              <h4>PPKS Report</h4>
              <p>
                A PPKS report is a report containing incidents of sexual violence experienced or seen by someone.</p>
              <div class="main-button">
                <a href="#">Read More</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="service-item">
            <div class="icon">
              <img src="{{asset('templatemo/assets/images/service-03.png')}}" alt="web experts">
            </div>
            <div class="main-content">
              <h4>Backup Data</h4>
              <p>the process of making a copy of data from an electronic device to another storage medium to prevent data loss..</p>
              <div class="main-button">
                <a href="#">Read More</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


 
<!-- Daftar -->
  <div class="section fun-facts">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="wrapper">
            <div class="row">
              <div class="col-lg-3 col-md-6">
              <div class="counter">
                  <h2 class="timer count-title count-number" data-to="{{ $totalUser }}" data-speed="1000"></h2>
                  <p class="count-text">Users Website</p>
              </div>

              </div>
              <div class="col-lg-3 col-md-6">
                <div class="counter">
                  <h2 class="timer count-title count-number" data-to="{{ $totalPengaduan }}" data-speed="1000"></h2>
                  <p class="count-text ">Pelaporan</p>
                </div>
              </div>
              <div class="col-lg-3 col-md-6">
                <div class="counter">
                  <h2 class="timer count-title count-number" data-to="{{$jumlahanggotasatgas}}" data-speed="1000"></h2>
                  <p class="count-text ">Jumlah Anggota Satgas</p>
                </div>
              </div>
              <div class="col-lg-3 col-md-6">
                <div class="counter end">
                 <h2 class="timer count-title count-number" data-to="{{ $KasusSelesai }}" data-speed="1000"></h2>
                  <p class="count-text ">Kasus Selesai</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="team section" id="team">
    <div class="container">
        <div class="row">
            @php
                $team = [
                    ['role' => 'Ketua Satgas', 'name' => 'Nursetia Wati, S.SI., M.Kom', 'image' => $ketua->image ?? null],
                    ['role' => 'Sekretaris', 'name' => 'Nurhafnita, S.Kom., M.Kom', 'image' => $sekretaris->image ?? null],
                    ['role' => 'Anggota', 'name' => 'Fajar Hermawanto, S.T., M.OM', 'image' => $anggota[0]->image ?? null],
                    ['role' => 'Anggota', 'name' => 'Nur Syamsi Ibrahim, S.TP., M.Sc', 'image' => $anggota[1]->image ?? null],
                ];
            @endphp

            @foreach($team as $member)
                <div class="col-lg-3 col-md-6">
                    <div class="team-member text-center">
                        <div class="main-content">
                            <img src="{{ $member['image'] ? asset('storage/' . $member['image']) : 'https://via.placeholder.com/150' }}" 
                                 alt="Foto {{ $member['role'] }}" 
                                 class="img-fluid rounded-circle team-img">
                            <span class="category">{{ $member['role'] }}</span>
                            <h4>{{ $member['name'] }}</h4>
                            <ul class="social-icons">
                                <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- visi dan misi -->
  <div class="section testimonials" id="visimisi">
    <div class="container">
      <div class="row">
        <div class="col-lg-7">
          <div class="owl-carousel owl-testimonials">
            <div class="item">
                <div class="author">
                    <img src="assets/images/testimonial-author.jpg" alt="">
                    <h4>Visi Satgas PPKS</h4>
                </br>
                    <p>“Please tell your friends or collegues about TemplateMo website. Anyone can access the website to download free templates. Thank you for visiting.”</p>
                    <span class="category"></span>
              </div>
            </div>
            <div class="item">
                <div class="author">
                    <img src="assets/images/testimonial-author.jpg" alt="">
                    <h4>Misi Satgas PPKS</h4>
                </br>
                    <p>“Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravid.”</p>
                {{-- <span class="category">UI Expert</span> --}}
              </div>
            </div>

          </div>
        </div>
        <div class="col-lg-5 align-self-center">
          <div class="section-heading">
            <h6>Tujuan Satgas PPKS</h6>
            <h2>What is the purpose of the task force?</h2>
            <p>The PPKS Task Force or Task Force for the Prevention and Handling of Sexual Violence has a big role in anticipating the rise of this phenomenon. It is hoped that victims of sexual violence will have the courage to speak up and report the incidents they experienced.</p>
          </div>
        </div>
      </div>
    </div>
  </div>

 
<!-- Register -->
  <div class="contact-us section" id="contact">
    <div class="container">
      <div class="row">
      <div class="col-lg-6 col-md-12 align-self-center">
        <div class="section-heading text-center text-lg-start">
            <h6>Hubungi Satgas</h6>
            <h2>Kami Siap Membantu Anda</h2>
            <p>Satgas Politeknik Gorontalo siap menerima laporan, pengaduan, dan memberikan solusi terbaik untuk keamanan dan kenyamanan bersama.</p>
            <p class="mt-3 fw-bold">
                Masukkan <span class="text-primary">NIM/NIDN</span> Anda di samping untuk melakukan pengaktivan akun dan pembuatan laporan.
                <i class="bi bi-arrow-right fs-4 text-primary"></i>
            </p>
          </div>
        </div>

        
       <div class="col-lg-6">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    @include('layouts.alert1')
                </div>
            </div>
        </div>
    <div class="contact-us-content">

        <form id="contact-form" action="{{ route('register') }}" method="post">
            @csrf
            <div class="row">
                <!-- Input for No Identitas -->
                <div class="form-group">
                    <label for="no_identitas">No Identitas</label>
                    <input id="no_identitas" type="text"
                        class="form-control @error('no_identitas') is-invalid @enderror"
                        name="no_identitas" placeholder="Masukan NIM atau NIDN Anda" 
                        value="{{ old('no_identitas') }}" required autofocus>
                    @error('no_identitas')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Input for Email -->
                <div class="form-group">
                    <label for="email_penerima_akun">Email Penerima Akun Aktif</label>
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
            </div>
        </form>
    </div>
</div>
      </div>
    </div>
  </div>

  <footer>
    <div class="container">
      <div class="col-lg-12">
        <p>Copyright © 2025 Satgas PPKS. All rights reserved. &nbsp;&nbsp;&nbsp; Design: <a href="https://templatemo.com" rel="nofollow" target="_blank">TemplateMo</a></p>
      </div>
    </div>
  </footer>

  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
  <script src="{{ asset ('templatemo/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{ asset ('templatemo/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
  <script src="{{ asset ('templatemo/assets/js/isotope.min.js')}}"></script>
  <script src="{{ asset ('templatemo/assets/js/owl-carousel.js')}}"></script>
  <script src="{{ asset ('templatemo/assets/js/counter.js')}}"></script>
  <script src="{{ asset ('templatemo/assets/js/custom.js')}}"></script>

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

  </body>
</html>
