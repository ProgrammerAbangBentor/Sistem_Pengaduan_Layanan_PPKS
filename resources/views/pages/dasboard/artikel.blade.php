<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link href="{{ asset ('template/img/logo.png') }}" rel="icon">
  <title>Layanan Pengaduan Dan Penanganan Kekerasan seksual</title>

  <!-- Bootstrap core CSS -->
  <link href="{{ asset('templatemo/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

  <!-- Additional CSS Files -->
  <link rel="stylesheet" href="{{ asset('templatemo/assets/css/fontawesome.css')}}">
  <link rel="stylesheet" href="{{ asset('templatemo/assets/css/templatemo-scholar.css')}}">
  <link rel="stylesheet" href="{{ asset('templatemo/assets/css/owl.css')}}">
  <link rel="stylesheet" href="{{ asset('templatemo/assets/css/animate.css')}}">
  <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>

  <style>
    /* Menambahkan fixed positioning pada header */
    header {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      z-index: 1000;
      background-color: #9a1fff;
      padding: 10px 0;
    }

    body {
      background-color: #9a1fff;
      color: white;
      margin-top: 120px;
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

    /* Styling artikel untuk kotak */
    .container-article {
      margin-bottom: 30px;
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      padding: 20px;
    }

    .article {
      display: flex;
      background-color: #f9f9f9;
      border: 1px solid #ddd;
      border-radius: 8px;
      margin-bottom: 20px;
      padding: 15px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .article-image {
      flex: 1;
      max-width: 150px;
      margin-right: 20px;
      border-radius: 8px;
      overflow: hidden;
    }

    .article-image img {
      width: 100%;
      height: auto;
    }

    .article-content {
      flex: 3;
    }

    .article-title {
      font-size: 22px;
      font-weight: bold;
      color: #333;
    }

    .article-meta {
      font-size: 14px;
      color: #777;
      margin: 10px 0;
    }

    .article-description {
      font-size: 16px;
      color: #555;
    }

    .container-article a {
      color: #9a1fff;
      font-weight: bold;
      text-decoration: none;
    }

    .container-article a:hover {
      color: #5d0171;
    }

    /* Contact Form Section */
    .contact-us {
      background-color: #fff;
      padding: 50px 0;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .contact-us .container {
      max-width: 800px;
      margin: 0 auto;
    }

    .contact-us h6 {
      font-size: 18px;
      font-weight: bold;
      color: #9a1fff;
    }

    .contact-us h2 {
      font-size: 32px;
      color: #333;
    }

    .contact-us p {
      font-size: 16px;
      color: #555;
      margin-bottom: 20px;
    }

    .contact-us .special-offer {
      background-color: #f7f7f7;
      padding: 20px;
      border-radius: 8px;
      text-align: center;
    }

    .contact-us .special-offer h4 {
      font-size: 22px;
      color: #333;
    }

    .contact-us .special-offer span.offer {
      font-size: 36px;
      color: #9a1fff;
      font-weight: bold;
    }

    .contact-us .special-offer h6 {
      font-size: 14px;
      color: #777;
    }

    .contact-us .special-offer a {
      color: #9a1fff;
      font-weight: bold;
      text-decoration: none;
    }

    /* Button Scroll to Top */
    .scroll-to-top {
      position: fixed;
      bottom: 20px;
      right: 20px;
      background-color: #9a1fff;
      color: white;
      padding: 10px 15px;
      border-radius: 50%;
      display: none;
      cursor: pointer;
      z-index: 1000;
    }

    .scroll-to-top:hover {
      background-color: #5d0171;
    }

        .title-article1 {
        background-color: #9a1fff; /* Warna ungu */
        color: white; /* Warna tulisan putih */
        padding: 20px;
        text-align: center;
        font-size: 28px;
        font-weight: bold;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        }
  </style>
</head>

<body>
  <!-- Preloader Start -->
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
  <!-- Preloader End -->

  <!-- Header Area Start -->
  <header class="header-area header-sticky">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav class="main-nav">
            <div style="display: flex; align-items: center; gap: 10px;">
              <!-- Logo -->
              <a href="index.html" class="logo" style="display: flex; align-items: center;">
                <img src="{{ asset('templatemo/assets/images/logo4.png') }}" style="height: 50px; width: auto;">
              </a>
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
                            <li><a href="{{ route('dashboard') }}#visimisi">VisiMisi</a></li>

                        </ul>
                    </li>

                      <li class="scroll-to-section"><a href="{{ route('dashboard') }}#services">Services</a></li>
                      
                      <li class="scroll-to-section"><a href="{{ route('dashboard') }}#team">Team</a></li>
                    
                      <li class="scroll-to-section"><a href="{{ route('dashboard') }}#contact">Register Now!</a></li>
                  </ul>
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                    <!-- ***** Menu End ***** -->
            <a class="menu-trigger"><span>Menu</span></a>
          </nav>
        </div>
      </div>
    </div>
  </header>
  <!-- Header Area End -->

  <!-- Artikel Section -->
  <div class="container-article">
    <h1 class="title-article1">ARTIKEL</h1>
    <div class="title-article">Artikel</div>
    <div class="title-underline-article"></div>

    @if($artikels->isEmpty())
    <div class="alert alert-warning text-center">
        Data Artikel Belum Ada
    </div>
@else
    @foreach ($artikels as $art)
        <div class="article">
            <div class="article-image">
                <img src="{{ asset('storage/' . $art->image) }}" alt="Artikel Image">
            </div>
            <div class="article-content">
                <div class="article-title">{{ $art->title }}</div>
                <div class="article-description">{{ $art->content }}</div>
                <div class="article-meta">
                    ARTIKEL | {{ $art->created_at->format('d M Y') }} | Dibuat Oleh: {{ $art->user->name ?? 'Tidak Diketahui' }}
                </div>
            </div>
        </div>
    @endforeach
@endif

  </div>

  <!-- Footer Start -->
  <footer>
    <div class="container">
      <div class="col-lg-12">
        <p>Copyright © 2036 Scholar Organization. All rights reserved. &nbsp;&nbsp;&nbsp; Design: <a href="https://templatemo.com" rel="nofollow" target="_blank">TemplateMo</a></p>
      </div>
    </div>
  </footer>

  <!-- Scroll to Top Button -->
  <button class="scroll-to-top" id="scrollToTopBtn" onclick="scrollToTop()">↑</button>

  <!-- Scripts -->
  <script src="{{ asset('templatemo/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{ asset('templatemo/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
  <script src="{{ asset('templatemo/assets/js/isotope.min.js')}}"></script>
  <script src="{{ asset('templatemo/assets/js/owl-carousel.js')}}"></script>
  <script src="{{ asset('templatemo/assets/js/counter.js')}}"></script>
  <script src="{{ asset('templatemo/assets/js/custom.js')}}"></script>

  <!-- JavaScript for Scroll to Top Button -->
  <script>
    // Get the button
    var mybutton = document.getElementById("scrollToTopBtn");

    // When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function() {
      if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        mybutton.style.display = "block";
      } else {
        mybutton.style.display = "none";
      }
    };

    // When the user clicks on the button, scroll to the top of the document
    function scrollToTop() {
      document.body.scrollTop = 0;
      document.documentElement.scrollTop = 0;
    }
  </script>
</body>

</html>
