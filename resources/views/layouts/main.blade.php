@php
    $webData = DB::table('general_settings')->find(1);
@endphp
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>IT platform</title>
  <meta content="" name="description">

  <meta content="" name="keywords">

  <style>
    .rating {
  --dir: right;
  --fill: gold;
  --fillbg: rgba(100, 100, 100, 0.15);
  --heart: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 21.328l-1.453-1.313q-2.484-2.25-3.609-3.328t-2.508-2.672-1.898-2.883-0.516-2.648q0-2.297 1.57-3.891t3.914-1.594q2.719 0 4.5 2.109 1.781-2.109 4.5-2.109 2.344 0 3.914 1.594t1.57 3.891q0 1.828-1.219 3.797t-2.648 3.422-4.664 4.359z"/></svg>');
  --star: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 17.25l-6.188 3.75 1.641-7.031-5.438-4.734 7.172-0.609 2.813-6.609 2.813 6.609 7.172 0.609-5.438 4.734 1.641 7.031z"/></svg>');
  --stars: 5;
  --starsize: 3rem;
  --symbol: var(--star);
  --value: 1;
  --w: calc(var(--stars) * var(--starsize));
  --x: calc(100% * (var(--value) / var(--stars)));
  block-size: var(--starsize);
  inline-size: var(--w);
  position: relative;
  touch-action: manipulation;
  -webkit-appearance: none;
}
[dir="rtl"] .rating {
  --dir: left;
}
.rating::-moz-range-track {
  background: linear-gradient(to var(--dir), var(--fill) 0 var(--x), var(--fillbg) 0 var(--x));
  block-size: 100%;
  mask: repeat left center/var(--starsize) var(--symbol);
}
.rating::-webkit-slider-runnable-track {
  background: linear-gradient(to var(--dir), var(--fill) 0 var(--x), var(--fillbg) 0 var(--x));
  block-size: 100%;
  mask: repeat left center/var(--starsize) var(--symbol);
  -webkit-mask: repeat left center/var(--starsize) var(--symbol);
}
.rating::-moz-range-thumb {
  height: var(--starsize);
  opacity: 0;
  width: var(--starsize);
}
.rating::-webkit-slider-thumb {
  height: var(--starsize);
  opacity: 0;
  width: var(--starsize);
  -webkit-appearance: none;
}
.rating, .rating-label {
  display: block;
  font-family: ui-sans-serif, system-ui, sans-serif;
}
.rating-label {
  margin-block-end: 1rem;
}

/* NO JS */
.rating--nojs::-moz-range-track {
  background: var(--fillbg);
}
.rating--nojs::-moz-range-progress {
  background: var(--fill);
  block-size: 100%;
  mask: repeat left center/var(--starsize) var(--star);
}
.rating--nojs::-webkit-slider-runnable-track {
  background: var(--fillbg);
}
.rating--nojs::-webkit-slider-thumb {
  background-color: var(--fill);
  box-shadow: calc(0rem - var(--w)) 0 0 var(--w) var(--fill);
  opacity: 1;
  width: 1px;
}
[dir="rtl"] .rating--nojs::-webkit-slider-thumb {
  box-shadow: var(--w) 0 0 var(--w) var(--fill);
}
/* --star: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 17.25l-6.188 3.75 1.641-7.031-5.438-4.734 7.172-0.609 2.813-6.609 2.813 6.609 7.172 0.609-5.438 4.734 1.641 7.031z"/></svg>'); */

 </style>
  <!-- Favicons -->
  <link href="{{ asset("blog/img/favicon.png") }}" rel="icon">
  <link href="{{ asset("blog/img/apple-touch-icon.png") }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset("blog/vendor/aos/aos.css") }}" rel="stylesheet">
  <link href="{{ asset("blog/vendor/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet">
  <link href="{{ asset("blog/vendor/bootstrap-icons/bootstrap-icons.css") }}" rel="stylesheet">
  <link href="{{ asset("blog/vendor/glightbox/css/glightbox.min.css") }}" rel="styleshee"t>
  <link href="{{ asset("blog/vendor/remixicon/remixicon.css") }}" rel="stylesheet">
  <link href="{{ asset("blog/vendor/swiper/swiper-bundle.min.css") }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset("blog/css/style.css") }}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: FlexStart - v1.9.0
  * Template URL: https://bootstrapmade.com/flexstart-bootstrap-startup-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
    @livewireStyles
</head>

<body dir="rtl">
  <!-- ======= Header ======= -->
  <header  id="header" class="header fixed-top mb-5">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="{{ route("home") }}" class="logo d-flex align-items-center ">
        <img class="ms-3" src="blog/img/logo.png" alt="">
        <span>{{ $webData->website_name }}</span></span>
      </a>

      <nav id="navbar" class="navbar text-center mx-auto">
        <ul>
            @auth
                @if(request()->routeIs("home"))
                    {{--only the Super Admin and the Admin can be enter the Dasboard --}}
                     @if(auth()->user()->role_id ==  1 || auth()->user()->role_id ==  2)
                    <li><a class="nav-link scrollto fs-5" href="{{ route("dashboard.index",["id"=> auth()->id()]) }}">لوحة الحكم </a></li>
                    @endif

                    <li><a class="nav-link scrollto fs-5" href="{{ route("profile",["id"=>auth()->id()]) }}">الملف الشخصي</a></li>
                    <li><a class="nav-link scrollto fs-5" href="{{ route("logout") }}">تسجيل الخروج</a></li>
                @elseif (request()->routeIs("profile"))
                    <li><a class="nav-link scrollto fs-5" href="{{ route("home") }}">صفحة الرائسية</a></li>

                    {{--only the Super Admin and the Admin can be enter the Dasboard --}}
                    @if(auth()->user()->role_id ==  1 || auth()->user()->role_id ==  2)
                    <li><a class="nav-link scrollto fs-5" href="{{ route("dashboard.index",["id"=> auth()->id()]) }}">لوحة الحكم </a></li>
                    @endif

                    <li><a class="nav-link scrollto fs-5" href="{{ route("logout") }}">تسجيل الخروج</a></li>
                @elseif(request()->routeIs("comment"))
                    <li><a class="nav-link scrollto fs-5" href="{{ route("home") }}">صفحة الرائسية</a></li>
                    <li><a class="nav-link scrollto fs-5" href="{{ route("profile",["id"=>auth()->id()]) }}">الملف الشخصي</a></li>

                    {{--only the Super Admin and the Admin can be enter the Dasboard --}}
                    @if(auth()->user()->role_id ==  1 || auth()->user()->role_id ==  2)
                    <li><a class="nav-link scrollto fs-5" href="{{ route("dashboard.index",["id"=> auth()->id()]) }}">لوحة الحكم </a></li>
                    @endif

                    <li><a class="nav-link scrollto fs-5" href="{{ route("logout") }}">تسجيل الخروج</a></li>
                @elseif(request()->routeIs("showDetails"))
                    <li><a class="nav-link scrollto fs-5" href="{{ route("home") }}">صفحة الرائسية</a></li>
                    <li><a class="nav-link scrollto fs-5" href="{{ route("profile",["id"=>auth()->id()]) }}">الملف الشخصي</a></li>

                    {{--only the Super Admin and the Admin can be enter the Dasboard --}}
                    @if(auth()->user()->role_id ==  1 || auth()->user()->role_id ==  2)
                    <li><a class="nav-link scrollto fs-5" href="{{ route("dashboard.index",["id"=> auth()->id()]) }}">لوحة الحكم </a></li>
                    @endif

                    <li><a class="nav-link scrollto fs-5" href="{{ route("logout") }}">تسجيل الخروج</a></li>
                @else
                    <li><a class="nav-link scrollto active fs-5" href="{{ route("home") }}">صفحة الرائسية</a></li>
                @endif
            @endauth

            @guest
                @if(request()->routeIs("home"))
                    <li><a class="nav-link scrollto fs-5" href="{{ route("login") }}">تسجيل الدخول</a></li>
                    <li><a class="nav-link scrollto fs-5" href="{{ route("register") }}">انشاء حساب</a></li>
                @else
                    <li><a class="nav-link scrollto active" href="{{ route("home") }}">صفحة الرائسية</a></li>
                @endif
            @endguest




        </ul>
        <i class="bi bi-list mobile-nav-toggle m-0"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->


  @yield('content')



  <footer id="footer" class="footer mt-5">

    <div class="container">
      <div class="copyright">
         Copyright &copy; <strong><span>{{ $webData->website_copy_right }}</span></strong>
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/flexstart-bootstrap-startup-template/ -->
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset("blog/vendor/purecounter/purecounter.js") }}"></script>
  <script src="{{ asset("blog/vendor/aos/aos.js") }}"></script>
  <script src="{{ asset("blog/vendor/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
  <script src="{{ asset("blog/vendor/glightbox/js/glightbox.min.js") }}"></script>
  <script src="{{ asset("blog/vendor/isotope-layout/isotope.pkgd.min.js") }}"></script>
  <script src="{{ asset("blog/vendor/swiper/swiper-bundle.min.js") }}"></script>
  <script src="{{ asset("blog/vendor/php-email-form/validate.js") }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset("blog/js/main.js") }}"></script>

  @livewireScripts
</body>

</html>
