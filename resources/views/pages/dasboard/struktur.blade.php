<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Artikel - Satgas PPKS Poltekgo</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

     <!-- Favicon -->
     <link href="{{ asset ('template/img/logo.png') }}" rel="icon">

     <!-- Google Web Fonts -->
     <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@700;800&display=swap" rel="stylesheet">

     <!-- Icon Font Stylesheet -->
     <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

     <!-- Libraries Stylesheet -->
     <link href="{{ asset('template/lib/animate/animate.min.css') }}" rel="stylesheet">
     <link href="{{ asset('template/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

     <!-- Customized Bootstrap Stylesheet -->
     <link href="{{ asset('template/css/bootstrap.min.css') }}" rel="stylesheet">

     <!-- Template Stylesheet -->
     <link href="{{ asset('template/css/style.css') }}" rel="stylesheet">

    <style>
        /* Global styles for purple theme */
        body {
            background-color: #f4f4f9;
        }

        h2 {
            margin-bottom: 30px;
            font-weight: bold;
            color: #6a1b9a; /* Purple color for heading */
        }

        /* Profile image styling */
        .profile-image {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #6a1b9a; /* Purple border around the image */
        }

        /* Card container and individual card styles */
        .card {
            margin-bottom: 20px;
            border-radius: 15px;
            border: 1px solid #6a1b9a; /* Purple border around cards */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%; /* Ensures cards have the same height */
        }

        .card-body {
            text-align: center;
            padding: 20px;
            flex-grow: 1; /* Makes the card body take up available space */
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
            color: #6a1b9a; /* Purple color for titles */
        }

        .card-text {
            font-size: 1rem;
            color: #777;
        }

        .card-body p {
            margin-top: 10px;
            color: #6a1b9a; /* Purple color for the paragraph text */
        }

        /* Profile container styling */
        .profile-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* Container and row styling */
        .container {
            padding: 40px;
        }

        .row {
            margin-top: 20px;
        }

        .col-md-4, .col-lg-3 {
            margin-bottom: 20px;
        }

        /* Purple button style */
        .btn-purple {
            background-color: #6a1b9a;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            text-align: center;
            cursor: pointer;
        }

        .btn-purple:hover {
            background-color: #9c4dcc; /* Lighter purple on hover */
        }
    </style>
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar Start -->
        <div class="container-fluid nav-bar bg-transparent">
            <nav class="navbar navbar-expand-lg bg-white navbar-light py-0 px-4">
                <a href="index.html" class="navbar-brand d-flex align-items-center text-center">
                    <div>
                        <img class="img-fluid" src="{{ asset ('template/img/logo.png') }}" alt="Icon" style="width: 45px; height: 45px;">
                    </div>
                    <h1 class="m-0 text-basic">&nbsp; SATGAS PPKS POLTEKGO</h1>
                </a>
                <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto">
                        <a href="{{ route('dashboard') }}" class="nav-item  nav-link ">Beranda</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Profile</a>
                            <div class="dropdown-menu rounded-0 m-0">
                                <a href="property-agent.html" class="dropdown-item">Pengantar</a>
                                <a href="property-type.html" class="dropdown-item">Visi Dan Misi</a>
                                <a href="{{ route('struktur') }}" class="dropdown-item ">Struktrur Organisasi</a>
                            </div>
                        </div>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Kekerasan Seksual</a>
                            <div class="dropdown-menu rounded-0 m-0">
                                <a href="testimonial.html" class="dropdown-item">Pencegahan</a>
                                <a href="404.html" class="dropdown-item">Penanganan</a>
                            </div>
                        </div>
                        <a href="about.html" class="nav-item nav-link active">Artikel</a>
                    </div>
                    <a href="{{ route('login') }}" class="btn btn-dark px-3 d-none d-lg-flex"><b>Masuk</b></a> <!-- Perhatikan href di sini -->
                </div>
            </nav>
        </div>
        <!-- Navbar End -->

    <div class="container mt-5">
        <h2 class="text-center">Struktur Organisasi SATGAS PPKS Poltekgo</h2>

        <div class="row justify-content-center">
            <!-- Ketua (Baris pertama) -->
            <div class="col-md-4">
                <div class="card">
                    @if (is_string($ketua))
                    <div class="col-lg-12">
                        <p>{{ $ketua }}</p>
                    </div>
                    @else
                    <div class="profile-container">
                        <img src="{{ asset('storage/' . $ketua->image) }}" alt="Ketua" class="profile-image">
                        <div class="card-body">
                            <h5 class="card-title">{{ $ketua->name }}</h5>
                            <p class="card-text">{{ $ketua->status }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <!-- Bendahara dan Sekretaris (Baris kedua) -->
            <div class="col-md-6 col-lg-4">
                <div class="card">
                    <div class="profile-container">
                        <img src="https://via.placeholder.com/100" alt="Bendahara" class="profile-image">
                        <div class="card-body">
                            <h5 class="card-title">Bendahara</h5>
                            <p class="card-text">Mahasiswa FP</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card">
                    @if (is_string($sekretaris))
                    <div class="col-lg-12">
                        <p>{{ $sekretaris }}</p>
                    </div>
                    @else
                    <div class="profile-container">
                        <img src="{{ asset('storage/' . $sekretaris->image) }}" alt="Sekretaris" class="profile-image">
                        <div class="card-body">
                            <h5 class="card-title">{{ $sekretaris->name }}</h5>
                            <p class="card-text">{{ $sekretaris->status }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <!-- Anggota (Baris ketiga) -->
            @foreach ($anggota as $item)
            <div class="col-md-4 col-lg-3">
                <div class="card">
                    <div class="profile-container">
                        <img src="{{ asset('storage/' . $item->image) }}" alt="Anggota" class="profile-image">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->name }}</h5>
                            <p class="card-text">{{ $item->status }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

    </div>

     <!-- Footer Start -->
     <div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-white mb-4">Get In Touch</h5>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>G4F6+H8R, Desa Panggulo, Jl. Muchlis Rahim, West Panggulo, Botupingge, Bone Bolango Regency, Gorontalo 96112</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>(0435) 8702646</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>info@poligon.ac.id </p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-white mb-4">Quick Links</h5>
                    <a class="btn btn-link text-white-50" href="">About Us</a>
                    <a class="btn btn-link text-white-50" href="">Contact Us</a>
                    <a class="btn btn-link text-white-50" href="">Our Services</a>
                    <a class="btn btn-link text-white-50" href="">Privacy Policy</a>
                    <a class="btn btn-link text-white-50" href="">Terms & Condition</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-white mb-4">Photo Gallery</h5>
                    <div class="row g-2 pt-2">
                        <div class="col-4">
                            <img class="img-fluid rounded bg-light p-1" src="img/property-1.jpg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid rounded bg-light p-1" src="img/property-2.jpg" alt="">
                        </div>x
                        <div class="col-4">
                            <img class="img-fluid rounded bg-light p-1" src="img/property-3.jpg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid rounded bg-light p-1" src="img/property-4.jpg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid rounded bg-light p-1" src="img/property-5.jpg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid rounded bg-light p-1" src="img/property-6.jpg" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-white mb-4">Newsletter</h5>
                    <p>Dolor amet sit justo amet elitr clita ipsum elitr est.</p>
                    <div class="position-relative mx-auto" style="max-width: 400px;">
                        <input class="form-control bg-transparent w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email">
                        <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a class="border-bottom" href="http://poligon.ac.id/ ">PPKS Poltekgo</a>, All Right Reserved.

                        <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                        Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
</div>

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('template/lib/wow/wow.min.js') }}"></script>
<script src="{{ asset('template/lib/easing/easing.min.js') }}"></script>
<script src="{{ asset('template/lib/waypoints/waypoints.min.js') }}"></script>
<script src="{{ asset('template/lib/owlcarousel/owl.carousel.min.js') }}"></script>

<!-- Template Javascript -->
<script src="{{ asset('template/js/main.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
