<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sirait Apartment</title>
    <link rel="stylesheet" href="{{url('frontend/libraries/bootstrap/css/bootstrap.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Assistant:wght@200..800&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{url('frontend/styles/main.css')}}">
    

</head>
<body>

    <!-- navbar -->
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-white">
            <div class="container-fluid" style="height: 70px !important;">
                <a href="{{ url('/') }}" class="navbar-brand">
                    <img src="frontend/images/logo.png" alt="logo-apartment">
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
                            <a href="#popular" class="nav-link">Produk</a>
                        </li>
                        <li class="nav-item mx-md-2">
                            <a href="#popularcontent" class="nav-link">Fasilitas</a>
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

    <footer class="section-footer mt-5 mb-4 border-top">
        <div class="container pt-5 pb-5">
            <div class="row justify-content-center">
                <div class="col 12">
                    <div class="row">
                        <div class="col-12 col-lg-3">
                            <h5>FITUR</h5>
                            <ul class="list-unstyled">
                                <li><a href="#">Home</a></li>
                                <li><a href="#">Produk</a></li>
                                <li><a href="#">Fasilitas</a></li>
                            </ul>
                        </div>
                        <div class="col-12 col-lg-3">
                            
                        </div>
                        <div class="col-12 col-lg-3">
                            
                        </div>
                        <div class="col-12 col-lg-3">
                            <h5>SIRAIT APARTMENT</h5>
                            <ul class="list-unstyled">
                                <li><a href="#">Jakarta Selatan</a></li>
                                <li><a href="#">Indonesia</a></li>
                                <li><a href="#">06124562323</a></li>
                                <li><a href="#">siraitapartment@gmail.com</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row border-top justify-content-center align-items-center pt-4">
                <div class="col-auto text-gray-500 font-weight-light">
                    2024 copyright SiraitApartment . All right reserved . Made in Jakarta
                </div>
            </div>
        </div>
    </footer>
    <script src="{{url('frontend/libraries/jquery/jquery-3.7.1.min.js')}}"></script>
    <script src="{{url('frontend/libraries/bootstrap/js/bootstrap.js')}}"></script>
    <script src="{{url('frontend/libraries/retina/retina.min.js')}}"></script>
    
</body>
</html>