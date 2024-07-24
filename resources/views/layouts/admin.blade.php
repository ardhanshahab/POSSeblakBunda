<html>
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>SEBLAK BUNDA Raziel</title>
        {{-- <link rel="shortcut icon" href="{{ $app_logo }}" type="image/x-icon"> --}}
        <!-- General CSS Files -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

        <!-- CSS Libraries -->

        <!-- Template CSS -->
        {{-- <link rel="stylesheet" href="{{ asset('stisla') }}/modules/owlcarousel2/owl.carousel.min.css"> --}}
        {{-- <link rel="stylesheet" href="{{ asset('stisla') }}/modules/owlcarousel2/owl.theme.default.min.css"> --}}
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
        {{-- <link rel="stylesheet" href="{{ asset('stisla') }}/css/style.css"> --}}
        {{-- <link rel="stylesheet" href="{{ asset('stisla') }}/css/components.css"> --}}
        <link rel="stylesheet" type="text/css" href="{{ asset('datatables') }}/datatables.min.css"/>
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
        <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
        @stack('css')
    </head>
    <style>

            @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
            *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
            }
            .sidebar{
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 260px;
            background: #16114d;
            z-index: 100;
            transition: all 0.5s ease;
            }
            .sidebar.close{
            width: 78px;
            }
            .sidebar .logo-details{
            height: 60px;
            width: 100%;
            display: flex;
            align-items: center;
            }
            .sidebar .logo-details i{
            font-size: 30px;
            color: #fff;
            height: 50px;
            min-width: 78px;
            text-align: center;
            line-height: 50px;
            }
            .sidebar .logo-details .logo_name{
            font-size: 22px;
            color: #fff;
            font-weight: 600;
            transition: 0.3s ease;
            transition-delay: 0.1s;
            }
            .sidebar.close .logo-details .logo_name{
            transition-delay: 0s;
            opacity: 0;
            pointer-events: none;
            }
            .sidebar .nav-links{
            height: 100%;
            padding: 30px 0 150px 0;
            overflow: auto;
            }
            .sidebar.close .nav-links{
            overflow: visible;
            }
            .sidebar .nav-links::-webkit-scrollbar{
            display: none;
            }
            .sidebar .nav-links li{
            position: relative;
            list-style: none;
            transition: all 0.4s ease;
            }
            .sidebar .nav-links li:hover{
            background: #1d1b31;
            }
            .sidebar .nav-links li .iocn-link{
            display: flex;
            align-items: center;
            justify-content: space-between;
            }
            .sidebar.close .nav-links li .iocn-link{
            display: block
            }
            .sidebar .nav-links li i{
            height: 50px;
            min-width: 78px;
            text-align: center;
            line-height: 50px;
            color: #fff;
            font-size: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            }
            .sidebar .nav-links li.showMenu i.arrow{
            transform: rotate(-180deg);
            }
            .sidebar.close .nav-links i.arrow{
            display: none;
            }
            .sidebar .nav-links li a{
            display: flex;
            align-items: center;
            text-decoration: none;
            }
            .sidebar .nav-links li a .link_name{
            font-size: 18px;
            font-weight: 400;
            color: #fff;
            transition: all 0.4s ease;
            }
            .sidebar.close .nav-links li a .link_name{
            opacity: 0;
            pointer-events: none;
            }
            .sidebar .nav-links li .sub-menu{
            padding: 6px 6px 14px 80px;
            margin-top: -10px;
            background: #1d1b31;
            display: none;
            }
            .sidebar .nav-links li.showMenu .sub-menu{
            display: block;
            }
            .sidebar .nav-links li .sub-menu a{
            color: #fff;
            font-size: 15px;
            padding: 5px 0;
            white-space: nowrap;
            opacity: 0.6;
            transition: all 0.3s ease;
            }
            .sidebar .nav-links li .sub-menu a:hover{
            opacity: 1;
            }
            .sidebar.close .nav-links li .sub-menu{
            position: absolute;
            left: 100%;
            top: -10px;
            margin-top: 0;
            padding: 10px 20px;
            border-radius: 0 6px 6px 0;
            opacity: 0;
            display: block;
            pointer-events: none;
            transition: 0s;
            }
            .sidebar.close .nav-links li:hover .sub-menu{
            top: 0;
            opacity: 1;
            pointer-events: auto;
            transition: all 0.4s ease;
            }
            .sidebar .nav-links li .sub-menu .link_name{
            display: none;
            }
            .sidebar.close .nav-links li .sub-menu .link_name{
            font-size: 18px;
            opacity: 1;
            display: block;
            }
            .sidebar .nav-links li .sub-menu.blank{
            opacity: 1;
            pointer-events: auto;
            padding: 3px 20px 6px 16px;
            opacity: 0;
            pointer-events: none;
            }
            .sidebar .nav-links li:hover .sub-menu.blank{
            top: 50%;
            transform: translateY(-50%);
            }

            .one {
            width: 80%;
            margin-left: 10%;
            background-color: black;
            height: 400px;
            }

            .sidebar .profile-details{
            position: fixed;
            bottom: 0;
            width: 260px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #1d1b31;
            padding: 12px 0;
            transition: all 0.5s ease;
            }
            .sidebar.close .profile-details{
            background: none;
            }
            .sidebar.close .profile-details{
            width: 78px;
            }
            .sidebar .profile-details .profile-content{
            display: flex;
            align-items: center;
            }
            .sidebar .profile-details img{
            height: 52px;
            width: 52px;
            object-fit: cover;
            border-radius: 16px;
            margin: 0 14px 0 12px;
            background: #1d1b31;
            transition: all 0.5s ease;
            }
            .sidebar.close .profile-details img{
            padding: 10px;
            }
            .sidebar .profile-details .profile_name,
            .sidebar .profile-details .job{
            color: #fff;
            font-size: 18px;
            font-weight: 500;
            white-space: nowrap;
            }
            .sidebar.close .profile-details i,
            .sidebar.close .profile-details .profile_name,
            .sidebar.close .profile-details .job{
            display: none;
            }
            .sidebar .profile-details .job{
            font-size: 12px;
            }
            .home-section{
            position: relative;
            background: #E4E9F7;
            height: 100vh;
            left: 260px;
            width: calc(100% - 260px);
            transition: all 0.5s ease;
            }
            .sidebar.close ~ .home-section{
            left: 78px;
            width: calc(100% - 78px);
            }
            .home-section .home-content{
            height: 60px;
            display: flex;
            align-items: center;
            }
            .home-section .home-content .bx-menu,
            .home-section .home-content .text{
            color: #11101d;
            font-size: 35px;
            }
            .home-section .home-content .bx-menu{
            margin: 0 15px;
            cursor: pointer;
            }
            .home-section .home-content .text{
            font-size: 26px;
            font-weight: 600;
            }
            @media (max-width: 420px) {
            .sidebar.close .nav-links li .sub-menu{
                display: none;
            }
            }
    </style>
    <body>
        <div id="app">
            <div class="sidebar close">
                <div class="logo-details">
                  <i class='bx bxl-c-plus-plus'></i>
                  <span class="logo_name">Seblak Bunda Raziel</span>
                </div>
                <ul class="nav-links">
                  <li>
                    <a href="/home">
                      <i class='bx bx-grid-alt' ></i>
                      <span class="link_name">Dashboard</span>
                    </a>
                    <ul class="sub-menu blank">
                      <li><a class="link_name" href="/home">Dashboard</a></li>
                    </ul>
                  </li>
                  <li>
                    <div class="iocn-link">
                      <a href="#">
                        <i class='bx bx-collection' ></i>
                        <span class="link_name">Master</span>
                      </a>
                      <i class='bx bxs-chevron-down arrow' ></i>
                    </div>
                    <ul class="sub-menu">
                      <li><a class="link_name" href="#">Master</a></li>
                      <li><a href="/master/kategoriproduk">Kategori Produk</a></li>
                      <li><a href="/master/produk">Produk</a></li>
                      <li><a href="/master/meja">Meja</a></li>
                      <li><a href="/toppings">Toppings</a></li>
                      <li><a href="/user">User</a></li>
                    </ul>
                  </li>
                  <li>
                    <div class="iocn-link">
                      <a href="#">
                        <i class='bx bx-book-alt' ></i>
                        <span class="link_name">Laporan</span>
                      </a>
                      <i class='bx bxs-chevron-down arrow' ></i>
                    </div>
                    <ul class="sub-menu">
                      <li><a class="link_name" href="#">Laporan</a></li>
                      <li><a href="/order">Transaksi</a></li>
                      <li><a href="/cashier">Kasir</a></li>
                      {{-- <li><a href="#">Card Design</a></li> --}}
                    </ul>
                  </li>

                  <div class="profile-details">
                    <div class="profile-content">
                        <!--<img src="image/profile.jpg" alt="profileImg">-->
                    </div>
                    <div class="name-job">
                        <div class="profile_name">{{ Auth::user()->name }}</div>
                        <div class="job">Admin</div>
                    </div>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="logout-link">
                        <i class='bx bx-log-out'></i>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </div>
              </li>
            </ul>
              </div>
              <section class="home-section">
                <div class="home-content">
                  <i class='bx bx-menu' ></i>
                  <span class="text">Seblak Bunda Raziel</span>
                </div>
                    @yield('content')
              </section>
            </div>
        </div>
<script>
            let arrow = document.querySelectorAll(".arrow");
            for (var i = 0; i < arrow.length; i++) {
              arrow[i].addEventListener("click", (e)=>{
             let arrowParent = e.target.parentElement.parentElement;//selecting main parent of arrow
             arrowParent.classList.toggle("showMenu");
              });
            }
            let sidebar = document.querySelector(".sidebar");
            let sidebarBtn = document.querySelector(".bx-menu");
            console.log(sidebarBtn);
            sidebarBtn.addEventListener("click", ()=>{
              sidebar.classList.toggle("close");
            });
</script>
  <!-- General JS Scripts -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script type="text/javascript" src="{{ asset('datatables') }}/datatables.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
  <script src="/vendor/datatables/buttons.server-side.js"></script>
  {{-- <script src="{{ asset('stisla') }}/js/stisla.js"></script> --}}

  <!-- JS Libraies -->

  <!-- Template JS File -->
  {{-- <script src="{{ asset('stisla') }}/modules/owlcarousel2/owl.carousel.min.js"></script>
  <script src="{{ asset('stisla') }}/modules/summernote/summernote-bs4.js"></script>
  <script src="{{ asset('stisla') }}/js/scripts.js"></script>
  <script src="{{ asset('stisla') }}/js/custom.js"></script> --}}
  {{-- <script src="{{ asset('stisla') }}/js/page/modules-datatables.js"></script> --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>


  <script>
    $(() => {
      $("#table-1").dataTable({
        responsive : true
      });
    })

    function hapus(url){
      swal({
        title: "{{ __('message.dialog_title') }}",
        text: "{{ __('message.dialog_delete') }}",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          window.location.href = url;
        }
      });
    }

    $('.btn-delete').click(function(e) {
      e.preventDefault();
      var url = $(this).attr('href');
      swal({
        title: "{{ __('message.dialog_title') }}",
        text: "{{ __('message.dialog_delete') }}",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          window.location.href = url;
        }
      });
    });
  </script>
  @stack('js')
    </body>
</html>
