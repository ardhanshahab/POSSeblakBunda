<html>
    <head>
        <!-- Basic -->
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- Mobile Metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <!-- Site Metas -->
        <meta name="keywords" content="" />
        <meta name="description" content="" />
        <meta name="author" content="" />

        <title>Seblak Bunda Nazriel</title>


        <!-- bootstrap core css -->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.css') }}" />

        <!-- fonts style -->
        <link href="https://fonts.googleapis.com/css?family=Poppins:400,600,700&display=swap" rel="stylesheet">

        <!-- font awesome style -->
        <link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet" />
        <!-- nice select -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css" integrity="sha256-mLBIhmBvigTFWPSCtvdu6a76T+3Xyt+K571hupeFLg4=" crossorigin="anonymous" />
        <!-- slidck slider -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" integrity="sha256-UK1EiopXIL+KVhfbFa8xrmAWPeBjMVdvYMYkTAEv/HI=" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css.map" integrity="undefined" crossorigin="anonymous" />


        <!-- Custom styles for this template -->
        <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
        <!-- responsive style -->
        <link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet" />

      </head>
    <body>
        <div class="hero_area">
            <!-- header section strats -->
            <header class="header_section">
              <div class="container-fluid">
                <nav class="navbar navbar-expand-lg custom_nav-container">
                  <a class="navbar-brand" href="index.html">
                    <span>
                      Seblak Bunda Raziel
                    </span>
                  </a>
                  <div class="" id="">
                    <div class="User_option">
                      <a href="/login">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        <span>Login Pegawai</span>
                      </a>
                      {{-- <form class="form-inline ">
                        <input type="search" placeholder="Search" />
                        <button class="btn  nav_search-btn" type="submit">
                          <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                      </form> --}}
                    </div>
                    {{-- <div class="custom_menu-btn">
                      <button onclick="openNav()">
                        <img src="images/menu.png" alt="">
                      </button>
                    </div> --}}
                    {{-- <div id="myNav" class="overlay">
                      <div class="overlay-content">
                        <a href="index.html">Login Pegawai</a>
                      </div>
                    </div> --}}
                  </div>
                </nav>
              </div>
            </header>
            <!-- end header section -->

            <!-- slider section -->
            <section class="slider_section ">
              <div class="container ">
                <div class="row">
                  <div class="col-lg-10 mx-auto">
                    <div class="detail-box">
                      <h1>
                        Seblak Bunda Raziel
                      </h1>
                      <p>
                        Seblak Terenak Sejaga Raya
                      </p>
                    </div>
                    {{-- <div class="find_container ">
                      <div class="container">
                        <div class="row">
                          <div class="col">
                            <form>
                              <div class="form-row ">
                                <div class="form-group col-lg-5">
                                  <input type="text" class="form-control" id="inputHotel" placeholder="Restaurant Name">
                                </div>
                                <div class="form-group col-lg-3">
                                  <input type="text" class="form-control" id="inputLocation" placeholder="All Locations">
                                  <span class="location_icon">
                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                  </span>
                                </div>
                                <div class="form-group col-lg-3">
                                  <div class="btn-box">
                                    <button type="submit" class="btn ">Search</button>
                                  </div>
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div> --}}
                  </div>
                </div>
              </div>

            </section>
            <!-- end slider section -->
          </div>
        <div class="container-fluid" style="margin-top: 8px; margin-bottom:48px; padding-bottom:15px">
            @yield('content')
        </div>

        <div class="footer_container">
            <!-- footer section -->
            <footer class="footer_section">
              <div class="container">
                <p>
                  &copy; <span id="displayYear"></span> All Rights Reserved By
                  <a href="https://html.design/">Free Html Templates</a><br>
                  Distributed By: <a href="https://themewagon.com/">ThemeWagon</a>
                </p>
              </div>
            </footer>
            <!-- footer section -->

          </div>

    <!-- jQery -->
    <script src="{{ asset('assets/js/jquery-3.4.1.min.js') }}"></script>
    <!-- bootstrap js -->
    <script src="{{ asset('assets/js/bootstrap.js') }}"></script>
    <!-- slick  slider -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.js{{ asset('assets/css/bootstrap.css') }}"></script>
    <!-- nice select -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js" integrity="sha256-Zr3vByTlMGQhvMfgkQ5BtWRSKBGa2QlspKYJnkjZTmo=" crossorigin="anonymous"></script>
    <!-- custom js -->
    <script src="{{ asset('assets/js/custom.js') }}"></script>


  @stack('js')
    </body>
</html>
