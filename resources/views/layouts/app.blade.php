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
        <style>
            header {
                display: flex;
                justify-content: space-between;
                padding: 16px 24px;
                align-items: center;
                background-color: #4855fe;
                }

                #page_title {
                font-size: 18px;
                font-weight: 600;
                color: white;
                letter-spacing: .25px;
                }

                #addBtn {
                padding: 8px 24px;
                border-radius: 4px;
                font-weight: bold;
                font-size: 14px;
                text-transform: uppercase;
                cursor: pointer;
                }

                #addBtn {
                background-color: lightskyblue;
                border: none;
                }
        </style>
      </head>
    <body>
        <header>
            <h1 id="page_title">Seblak Bunda Nazriel</h1>
            <button id="addBtn">Add Item</button>
        </header>
        <div class="container mt-2">
            <div class="row">
                <div class="container-fluid" style="margin-top: 8px; margin-bottom:48px; padding-bottom:15px">
                    @yield('content')
                </div>
            </div>
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
