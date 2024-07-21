@extends('layouts.app')

@section('content')
    <!-- header -->
    <header class="text-center">
        <h1>Mari Bergabung Sebagai Pelanggan Sirait Apartment<br>Apartment Terbaik di Depok</h1>
        <p class="mt-3">Cocok untuk Keluarga Muda dan Mileneal</p>
        <a href="#" class="btn btn-get-started px-4 mt-4">Hubungi Kami</a>
    </header>

    <main>
        <div class="container">
            <section class="section-stats row justify-content-center" id="stats">
                <div class="col-3 col-md-2 stats-detail">
                    <h2>1000++</h2>
                    <p>Pembeli</p>
                </div>
                <div class="col-3 col-md-2 stats-detail">
                    <h2>500</h2>
                    <p>Apartment</p>
                </div>
                <div class="col-3 col-md-2 stats-detail">
                    <h2>4</h2>
                    <p>Negara</p>
                </div>
                <div class="col-3 col-md-2 stats-detail">
                    <h2>50</h2>
                    <p>Investor</p>
                </div>
            </section>
        </div>

        <section class="section-popular" id="popular">
            <div class="container">
                <div class="row">
                    <div class="col text-center section-popular-heading">
                        <h2>Jenis Tower Apartment</h2>
                        <p>Tower Yang Dicintai Pelanggan Kami</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-popular-content" id="popularcontent">
            <div class="container">
                <div class="section-popular-apartment row justify-content-center">
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="card-apartment text-center d-flex flex-column" style="background-image: url('frontend/images/apartment1.jpg');">
                            <div class="apartment-country">DEPOK</div>
                            <div class="apartment-location">Tower Akasia</div>
                            <div class="apartment-button mt-auto">
                                <a href="#" class="btn btn-apartment-details px-4">
                                    Hubungi Kami
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="card-apartment text-center d-flex flex-column" style="background-image: url('frontend/images/apartment2.jpg');">
                            <div class="apartment-country">DEPOK</div>
                            <div class="apartment-location">Tower Burberry</div>
                            <div class="apartment-button mt-auto">
                                <a href="#" class="btn btn-apartment-details px-4">
                                    Hubungi Kami
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="card-apartment text-center d-flex flex-column" style="background-image: url('frontend/images/apartment3.jpg');">
                            <div class="apartment-country">DEPOK</div>
                            <div class="apartment-location">Tower Assakinah</div>
                            <div class="apartment-button mt-auto">
                                <a href="#" class="btn btn-apartment-details px-4">
                                    Hubungi Kami
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="card-apartment text-center d-flex flex-column" style="background-image: url('frontend/images/apartment8.jpg');">
                            <div class="apartment-country">DEPOK</div>
                            <div class="apartment-location">Tower Cheryville</div>
                            <div class="apartment-button mt-auto">
                                <a href="#" class="btn btn-apartment-details px-4">
                                    Hubungi Kami
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-facility-heading" id="facilityHeading">
            <div class="container">
                <div class="row">
                    <div class="col text-center">
                        <h2>Fasilitas Yang Kami Berikan</h2>
                        <p>Kami memberikan kenyamanan bagi anda dengan fasilitas premium kami.</p>
                    </div>
                </div>
            </div>
        </section>

        <div class="section section-facility-content" id="facilityContent">
            <div class="container">
                <div id="carouselExampleCaptions" class="carousel slide">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                        <img src="frontend/images/playground.jpg" class="d-block w-100 image1" alt="..." style="max-height: 500px !important;object-fit: cover;">
                        <div class="carousel-caption d-none d-md-block" style="font-weight: bold;">
                            <h5>PLAYGROUND</h5>
                            <p>Anak anda nyaman bermain dilingkungan apartemen kami.</p>
                        </div>
                        </div>
                        <div class="carousel-item">
                        <img src="frontend/images/pool2.jpg" class="d-block w-100 image2" alt="..." style="max-height: 500px !important;object-fit: cover;">
                        <div class="carousel-caption d-none d-md-block" style="font-weight: bold;">
                            <h5>KOLAM RENANG</h5>
                            <p>Anda dapat memanjakan badan anda dengan kolam renang yang kami sediakan.</p>
                        </div>
                        </div>
                        <div class="carousel-item">
                        <img src="frontend/images/communal.jpg" class="d-block w-100 image3" alt="..." style="max-height: 500px !important;object-fit: cover;">
                        <div class="carousel-caption d-none d-md-block" style="font-weight: bold;">
                            <h5>RUANGAN KOMUNAL</h5>
                            <p>Anda dapat bekerja diruangan komunal yang kami sediakan.</p>
                        </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                    </div>
            </div>
        </div>
    </main>

@endsection