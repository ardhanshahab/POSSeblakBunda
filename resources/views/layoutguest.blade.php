<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Seblak Bunda</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .back-to-top {
        position: fixed;
        bottom: 20px;
        right: 20px;
        display: none;
    }
    </style>
</head>

<body>
    <div class="main-panel p-0">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container justify-content-between">
                <a class="navbar-brand" href="#">Seblak Bunda</a>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/login">Login as admin</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="content-wrapper">
            @yield('content')
        </div>

        <footer class="text-muted">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <p class="float-md-left">
                            <a href="#" class="text-decoration-none">Back to top <i class="fas fa-arrow-up"></i></a>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p class="float-md-right">
                            This Design From &copy; Bootstrap
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <p>
                            Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p>Risya</p>
                    </div>
                </div>
            </div>
        </footer>



</script>
<script src="https://kit.fontawesome.com/85b3409c34.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>
