<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>تخصصات</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset("assets2/img/favicon.png") }}" rel="icon">
  <link href="{{ asset("assets2/img/apple-touch-icon.png") }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset("assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="{{ asset("assets/vendor/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet">
  <link href="{{ asset("assets/vendor/bootstrap-icons/bootstrap-icons.css") }}" rel="stylesheet">
  <link href="{{ asset("assets/vendor/boxicons/css/boxicons.min.css") }}" rel="stylesheet">
  <link href="{{ asset("assets/vendor/glightbox/css/glightbox.min.css") }}" rel="stylesheet">
  <link href="{{ asset("assets/vendor/remixicon/remixicon.css") }}" rel="stylesheet">
  <link href="{{ asset("assets/vendor/swiper/swiper-bundle.min.css") }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset("assets/css/style.css") }}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Arsha - v4.7.1
  * Template URL: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top @if($page != "home") header-inner-pages  @endif" dir="ltr">
    <div class="container d-flex align-items-center">


      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      <h3 class="logo me-auto"><a href="{{ route('home') }}">Specialties</a></h3>
      <nav id="navbar" class="navbar">

        <ul>
            @auth
                @if($page =="home")
                    @if (auth()->user()->role =="user")
                        <li><a href="{{ route("profile",["id"=>auth()->id()]) }}" class="nav-link scrollto"  >profile</a></li>
                        <li><a href="{{ route("logout") }}" class="nav-link scrollto " >logout</a></li>
                    @else
                        <li><a href="{{ route("Dashboard") }}"  class="nav-link scrollto"  >Dashboard</a></li>
                        <li><a href="{{ route("profile",["id"=>auth()->id()]) }}" class="nav-link scrollto"  >profile</a></li>
                        <li><a href="{{ route("logout") }}" class="nav-link scrollto " >logout</a></li>
                    @endif

                @elseif($page =="profile")
                    @if (auth()->user()->role =="user")
                    <li><a href="{{ route("home") }}" class="nav-link scrollto active" >Home</a></li>
                    <li><a href="{{ route("logout") }}" class="nav-link scrollto " >logout</a></li>
                    @else
                    <li><a href="{{ route("home") }}" class="nav-link scrollto active" >Home</a></li>
                    <li><a href="{{ route("Dashboard") }}"  class="nav-link scrollto"  >Dashboard</a></li>
                    <li><a href="{{ route("logout") }}" class="nav-link scrollto " >logout</a></li>
                    @endif

                @else
                    @if (auth()->user()->role =="user")
                        <li><a href="{{ route("home") }}" class="nav-link scrollto active" >Home</a></li>
                        <li><a href="{{ route("profile",["id"=>auth()->id()]) }}" class="nav-link scrollto"  >profile</a></li>
                        <li><a href="{{ route("logout") }}" class="nav-link scrollto " >logout</a></li>
                    @else
                        <li><a href="{{ route("home") }}" class="nav-link scrollto active" >Home</a></li>
                        <li><a href="{{ route("Dashboard") }}"  class="nav-link scrollto"  >Dashboard</a></li>
                        <li><a href="{{ route("profile",["id"=>auth()->id()]) }}" class="nav-link scrollto" >profile</a></li>
                        <li><a href="{{ route("logout") }}" class="nav-link scrollto " >logout</a></li>
                    @endif
                @endif
            @endauth

          @guest
            @if($page =="home")
                <li><a href="{{ route("login") }}" class="nav-link scrollto " >login</a></li>
                <li><a href="{{ route("register") }}" class="nav-link scrollto" >register</a></li>
            @elseif($page =="login")
                <li><a href="{{ route("home") }}" class="nav-link scrollto active" >Home</a></li>
                <li><a href="{{ route("register") }}" class="nav-link scrollto" >register</a></li>

            @elseif($page =="register")
                <li><a href="{{ route("home") }}" class="nav-link scrollto active" >Home</a></li>
                <li><a href="{{ route("login") }}" class="nav-link scrollto " >login</a></li>
            @else
                <li><a href="{{ route("home") }}" class="nav-link scrollto active" >Home</a></li>
                <li><a href="{{ route("login") }}" class="nav-link scrollto " >login</a></li>
                <li><a href="{{ route("register") }}" class="nav-link scrollto" >register</a></li>
            @endif
          @endguest



        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

    @yield('content')



  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container footer-bottom clearfix " >
      <div class="copyright">
        &copy; Copyright <strong><span>Arsha</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://.com/arsha-free-bootstrap-html-template-corporate/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>bootstrapmade
      </div>
    </div>
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset("assets/vendor/aos/aos.js") }}"></script>
  <script src="{{ asset("assets/vendor/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
  <script src="{{ asset("assets/vendor/glightbox/js/glightbox.min.js") }}"></script>
  <script src="{{ asset("assets/vendor/isotope-layout/isotope.pkgd.min.js") }}"></script>
  <script src="{{ asset("assets/vendor/swiper/swiper-bundle.min.js") }}"></script>
  <script src="{{ asset("assets/vendor/waypoints/noframework.waypoints.js") }}"></script>
  <script src="{{ asset("assets/vendor/php-email-form/validate.js") }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset("assets/js/main.js") }}"></script>

</body>

</html>
