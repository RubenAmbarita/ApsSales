<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMANTAP - Data Monitoring</title>
    <link rel="icon" type="image/png" href="{{ asset('frontend/images/simantap.png') }}">
    <link rel="stylesheet" href="{{url('frontend/libraries/bootstrap/css/bootstrap.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Assistant:wght@200..800&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{url('frontend/styles/main.css')}}">
    

</head>
<body>

    <!-- navbar -->
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
            <div class="container-fluid" style="height: 70px !important;">
                <a href="{{ url('/') }}" class="navbar-brand">
                    <img src="frontend/images/SIMANTAP.png" alt="logo-apartment" style="height: 200px !important;">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                data-bs-target="#navbarNavAltMarkup" 
                aria-controls="navbarNavAltMarkup" 
                aria-expanded="false" 
                aria-label="Toggle navigation">

                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <ul class="navbar-nav me-auto my-lg-0">
                        <li class="nav-item mx-md-2">
                            <a href="{{ url('/') }}" class="nav-link">Home</a>
                        </li>
                        <li class="nav-item mx-md-2">
                            <a href="#fitur" class="nav-link">Fitur</a>
                        </li>
                        <li class="nav-item mx-md-2">
                            <a href="#keamanan" class="nav-link">Keamanan</a>
                        </li>
                    </ul>

                    <!-- mobile button -->
                     @guest
                        <form class="form-inline d-sm-block d-md-none">
                            <button class="btn btn-login my-2 my-sm-0" type="button" onclick="event.preventDefault(); location.href='{{url('login')}}';">
                                Masuk
                            </button>
                        </form>
                        <!-- desktop button -->
                        <form class="form-inline my-2 my-lg-0 d-none d-md-block">
                            <button class="btn btn-login btn-navbar-right my-2 my-sm-0 px-4" type="button" onclick="event.preventDefault(); location.href='{{url('login')}}';">
                                Masuk
                            </button>
                        </form>
                        @endguest


                        <!-- mobile button -->
                         @auth
                        <form class="form-inline d-sm-block d-md-none">
                            <button class="btn btn-login my-2 my-sm-0" type="button" onclick="event.preventDefault(); location.href='{{url('/admin')}}';">
                                Masuk
                            </button>
                        </form>
                        <!-- desktop button -->
                        <form class="form-inline my-2 my-lg-0 d-none d-md-block">
                            <button class="btn btn-login btn-navbar-right my-2 my-sm-0 px-4" type="button" onclick="event.preventDefault(); location.href='{{url('/admin')}}';">
                                Masuk
                            </button>
                        </form>
                        @endauth
                    </div>
            </div>
        </nav>
    </div>
    
    @yield('content')

    <footer class="section-footer mt-5 mb-2 border-top">
        <div class="container pt-5 pb-5">
            <div class="row justify-content-center">
                <div class="col 12">
                    <div class="row">
                        <div class="col-12 col-lg-3">
                            <h5>FITUR</h5>
                            <ul class="list-unstyled">
                                <li class="mb-2"><a href="{{ url('/') }}">Home</a></li>
                                <li class="mb-2"><a href="#fitur">Fitur</a></li>
                                <li><a href="#keamanan">Keamanan</a></li>
                            </ul>
                        </div>
                        <div class="col-12 col-lg-3">
                            
                        </div>
                        <div class="col-12 col-lg-3">
                            
                        </div>
                        <div class="col-12 col-lg-3">
                            <h5 class="mb-3">SIMANTAP - Direktorat TI DJKI</h5>
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.3183201745787!2d106.82679407812074!3d-6.221690444838418!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f34d0d2e18bf%3A0x4b74be698b5db4ad!2sDirektorat%20Jenderal%20Kekayaan%20Intelektual!5e0!3m2!1sid!2sid!4v1758071827412!5m2!1sid!2sid" 
                                width="300" height="100" style="border:0;" allowfullscreen="" loading="lazy" 
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                            <ul class="list-unstyled">
                                <li><p>Jl. H. R. Rasuna Said No.kav 8 9, RT.16/RW.4, Kuningan, East Kuningan, Jakarta, South Jakarta City, Jakarta 12940</p></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row border-top justify-content-center align-items-center pt-2 pb-2">
                <div class="col-auto text-gray-500 font-weight-light">
                    &copy; 2025 SIMANTAP . Semua Data Dilindungi . Made by Direktorat TI - Kekayaan Intelektual
                </div>
            </div>
        </div>
    </footer>
    <script src="{{url('frontend/libraries/jquery/jquery-3.7.1.min.js')}}"></script>
    <script src="{{url('frontend/libraries/bootstrap/js/bootstrap.js')}}"></script>
    <script src="{{url('frontend/libraries/retina/retina.min.js')}}"></script>
    <script src="{{url('frontend/scripts/lazy-bg.js')}}"></script>
    
</body>
</html>
