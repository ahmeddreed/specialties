<!DOCTYPE html>
<html lang="en">

    <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Components / Accordion - NiceAdmin Bootstrap Template</title>
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
        <div class="d-flex justify-content-center mt-5">
            <a href="{{ route("home") }}"class="logo d-flex align-items-center w-auto">
              <img src="{{ asset("assets2/img/logo.png") }}" alt="">
              <span class="d-none d-lg-block">الصفحة الرائسية</span>
            </a>
          </div><!-- End Logo -->
          
        @yield('content')


        <script src="{{ asset("assets2/vendor/apexcharts/apexcharts.min.js") }}"></script>
        <script src="{{ asset("assets2/vendor/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
        <script src="{{ asset("assets2/vendor/chart.js/chart.min.js") }}"></script>
        <script src="{{ asset("assets2/vendor/echarts/echarts.min.js") }}"></script>
        <script src="{{ asset("assets2/vendor/quill/quill.min.js") }}"></script>
        <script src="{{ asset("assets2/vendor/simple-datatables/simple-datatables.js") }}"></script>
        <script src="{{ asset("assets2/vendor/tinymce/tinymce.min.js") }}"></script>
        <script src="{{ asset("assets2/vendor/php-email-form/validate.js") }}"></script>

        <!-- Template Main JS File -->
        <script src="{{ asset("assets/js/main.js") }}"></script>

    </body>

</html>
