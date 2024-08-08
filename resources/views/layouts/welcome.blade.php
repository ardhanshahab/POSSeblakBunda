<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Seblak Bunda Raziel</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,700|Raleway" rel="stylesheet">
    <link href="{{ asset('aset/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('aset/css/open-iconic-bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('aset/css/animate.css') }}" rel="stylesheet" />

    <link href="{{ asset('aset/css/owl.carousel.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('aset/css/owl.theme.default.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('aset/css/magnific-popup.css') }}" rel="stylesheet" />

    <link href="{{ asset('aset/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
    <link href="{{ asset('aset/css/jquery.timepicker.css') }}" rel="stylesheet" />
    <link href="{{ asset('aset/css/icomoon.css') }}" rel="stylesheet" />
    <link href="{{ asset('aset/css/style.css') }}" rel="stylesheet" />

  </head>
  <body data-spy="scroll" data-target="#site-navbar" data-offset="200">

    <nav class="navbar navbar-expand-lg navbar-dark site_navbar bg-dark site-navbar-light" id="site-navbar">
      <div class="container">
        <a class="navbar-brand" href="index.html">Seblak Bunda Raziel</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#site-nav" aria-controls="site-nav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="site-nav">
          <ul class="navbar-nav ml-auto">
            {{-- <li class="nav-item active"><a href="#section-home" class="nav-link">Home</a></li>
            <li class="nav-item"><a href="#section-about" class="nav-link">About</a></li>
            <li class="nav-item"><a href="#section-offer" class="nav-link">Offer</a></li>
            <li class="nav-item"><a href="#section-menu" class="nav-link">Menu</a></li>
            <li class="nav-item"><a href="#section-news" class="nav-link">News</a></li>
            <li class="nav-item"><a href="#section-gallery" class="nav-link">Gallery</a></li> --}}
            <li class="nav-item"><a href="/login" class="nav-link">Login Pegawai</a></li>
          </ul>
        </div>
      </div>
    </nav>


                @yield('content')


    <script src="{{ asset('aset/js/jquery.min.js') }}"></script>
    <script src="{{ asset('aset/js/popper.min.js') }}"></script>
    <script src="{{ asset('aset/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('aset/js/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('aset/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('aset/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('aset/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('aset/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('aset/js/jquery.timepicker.min.js') }}"></script>
    <script src="{{ asset('aset/js/jquery.animateNumber.min.js') }}"></script>
    <script src="{{ asset('aset/js/google-map.js') }}"></script>
    <script src="{{ asset('aset/js/main.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  </body>
</html>
