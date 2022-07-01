<!DOCTYPE html>
<html lang="en">

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
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset("assets2/vendor/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet">
  <link href="{{ asset("assets2/vendor/bootstrap-icons/bootstrap-icons.css") }}" rel="stylesheet">
  <link href="{{ asset("assets2/vendor/boxicons/css/boxicons.min.css") }}" rel="stylesheet">
  <link href="{{ asset("assets2/vendor/quill/quill.snow.css") }}" rel="stylesheet">
  <link href="{{ asset("assets2/vendor/quill/quill.bubble.css") }}" rel="stylesheet">
  <link href="{{ asset("assets2/vendor/remixicon/remixicon.css") }}" rel="stylesheet">
  <link href="{{ asset("assets2/vendor/simple-datatables/style.css") }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset("assets2/css/style.css") }}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin - v2.2.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
@if ($page != "profile")

    <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="{{ route("home") }}" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">Specialties</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->


    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">



        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <span class="d-none d-md-block dropdown-toggle ps-2">{{ auth()->user()->name }}</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">

            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{ route("profile",['id'=>auth()->id()]) }}">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>


            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{ route("logout") }}">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route("Dashboard") }}">
              <i class="bi bi-grid"></i>
              <span>Dashboard</span>
            </a>
          </li><!-- End Dashboard Nav -->



      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Tables</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route("userTable") }}">
              <i class="bi bi-circle"></i><span>Users Tables</span>
            </a>
          </li>

          <li>
            <a href="{{ route("specialtyTable") }}">
              <i class="bi bi-circle"></i><span>Specialties Tables</span>
            </a>
          </li>

          <li>
            <a href="{{ route("branchesTable") }}">
              <i class="bi bi-circle"></i><span>Branches Tables</span>
            </a>
          </li>

          <li>
            <a href="{{ route("languageTable") }}">
              <i class="bi bi-circle"></i><span>Languages Tables</span>
            </a>
          </li>

          <li>
            <a href="{{ route("BrLngTable") }}">
              <i class="bi bi-circle"></i><span>Branch Language Tables</span>
            </a>
          </li>

          <li>
            <a href="{{ route("coursesTable") }}">
              <i class="bi bi-circle"></i><span>Courses Tables</span>
            </a>
          </li>


        </ul>
      </li><!-- End Tables Nav -->


     <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route("home") }}">
           <i class="bi bi-house-door"></i><span>Home</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route("logout") }}">
            <i class="bi bi-box-arrow-left"></i><span>Logout</span>
        </a>
      </li><!-- End Dashboard Nav -->

    </ul>

  </aside><!-- End Sidebar-->

@endif


  <main id="main" class="main">

    {{-- <div class="pagetitle">
      <h1>Blank Page</h1>

    </div><!-- End Page Title --> --}}

    @yield("content")




  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset("assets2/vendor/apexcharts/apexcharts.min.js") }}"></script>
  <script src="{{ asset("assets2/vendor/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
  <script src="{{ asset("assets2/vendor/chart.js/chart.min.js") }}"></script>
  <script src="{{ asset("assets2/vendor/echarts/echarts.min.js") }}"></script>
  <script src="{{ asset("assets2/vendor/quill/quill.min.js") }}"></script>
  <script src="{{ asset("assets2/vendor/simple-datatables/simple-datatables.js") }}"></script>
  <script src="{{ asset("assets2/vendor/tinymce/tinymce.min.js") }}"></script>
  <script src="{{ asset("assets2/vendor/php-email-form/validate.js") }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset("assets2/js/main.js") }}"></script>
  <script src="{{ asset("assets2/js/ckeditor.js") }}"></script>
  <script>
    ClassicEditor
      .create( document.querySelector( '#editor' ), {
        // toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
      } )
      .then( editor => {
        window.editor = editor;
      } )
      .catch( err => {
        console.error( err.stack );
      } );
  </script>

<script>
    ClassicEditor
      .create( document.querySelector( '#editor2' ), {
        // toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
      } )
      .then( editor => {
        window.editor = editor;
      } )
      .catch( err => {
        console.error( err.stack );
      } );
  </script>

</body>

</html>
