@extends('layouts.app')

@section('content')
    <!-- header -->
    <header class="text-center">
        <h1>Simpan dan Amankan Data Penting Anda</h1>
        <p class="mt-3">SIMANTAP hadir sebagai solusi penyimpanan data penting </br>dengan keamanan tingkat tinggi dan akses yang mudah kapan saja, di mana saja.</p>
        <a href="{{ url('/login') }}" class="btn btn-get-started px-4 mt-4">Mulai Sekarang</a>
    </header>

    <main>
        <div class="container">
            <section class="section-stats row justify-content-center" id="stats">
                <div class="col-3 col-md-2 stats-detail">
                    <h2>
                        <span class="stat-number">1000</span><span class="stat-suffix">++</span>
                    </h2>
                    <p>Data Tersimpan</p>
                </div>
                <div class="col-3 col-md-2 stats-detail">
                    <h2>
                        <span class="stat-number">500</span><span class="stat-suffix">++</span>
                    </h2>
                    <p>Pengguna</p>
                </div>
                <div class="col-3 col-md-2 stats-detail">
                    <h2>
                        <span class="stat-number">100</span><span class="stat-suffix">%</span>
                    </h2>
                    <p>Tingkat Keamanan</p>
                </div>
                <div class="col-3 col-md-2 stats-detail">
                    <h2>
                        <span class="stat-prefix">+</span><span class="stat-number">20</span><span class="stat-suffix">%</span>
                    </h2>
                    <p>Pertumbuhan</p>
                </div>
            </section>
        </div>

        <section class="section-popular" id="fitur">
            <div class="container">
                <div class="row">
                    <div class="col text-center section-popular-heading">
                        <h2>Fitur Unggulan</h2>
                        <p>menyimpan data penting Anda dengan keamanan enkripsi tinggi dan akses terkontrol</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-popular-content" id="popularcontent">
            <div class="container">
                <div class="section-popular-apartment row justify-content-center">
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="card-apartment text-center d-flex flex-column lazy-bg" data-bg="frontend/images/data.jpg">
                            <div class="apartment-country">KEAMANAN & PRIVASI</div>
                            <div class="apartment-location">Enkripsi end-to-end untuk setiap dokumen</div>
                            <div class="apartment-button mt-auto">
                                <a href="#" class="btn btn-apartment-details px-4">
                                    Selengkapnya
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="card-apartment text-center d-flex flex-column lazy-bg" data-bg="frontend/images/data2.jpg">
                            <div class="apartment-country">MANAJEMEN ARSIP</div>
                            <div class="apartment-location">Pencarian cepat (smart search) dengan filter berdasarkan kategori, tanggal, jenis file, dll.</div>
                            <div class="apartment-button mt-auto">
                                <a href="#" class="btn btn-apartment-details px-4">
                                    Selengkapnya
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="card-apartment text-center d-flex flex-column lazy-bg" data-bg="frontend/images/data3.jpg">
                            <div class="apartment-country">AKSESIBILITAS & KOLABORASI</div>
                            <div class="apartment-location">Akses multiplatform (web, mobile, desktop) & Integrasi cloud storage (Google Drive)</div>
                            <div class="apartment-button mt-auto">
                                <a href="#" class="btn btn-apartment-details px-4">
                                    Selengkapnya
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="card-apartment text-center d-flex flex-column lazy-bg" data-bg="frontend/images/data4.jpg">
                            <div class="apartment-country">FITUR PENDUKUNG</div>
                            <div class="apartment-location">Dashboard interaktif untuk monitoring arsip dan statistik penggunaan.</div>
                            <div class="apartment-button mt-auto">
                                <a href="#" class="btn btn-apartment-details px-4">
                                    Selengkapnya
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-facility-heading" id="keamanan">
            <div class="container">
                <div class="row">
                    <div class="col text-center">
                        <h2>Keamanan yang Ditawarkan</h2>
                        <p>Kami memberikan kenyamanan bagi anda dengan keamanan yang kami tawarkan.</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="section-popular-content" id="popularcontent">
            <div class="container">
                <div class="section-keamanan row justify-content-center">
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="card-apartment text-center d-flex flex-column" style="background-image: url('frontend/images/keunggulan3.jpg');">
                            <div class="apartment-country">KONTROL AKSES BERBASIS PERAN</div>
                            <div class="apartment-location">Setiap pengguna hanya bisa mengakses sesuai kewenangannya.</div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="card-apartment text-center d-flex flex-column" style="background-image: url('frontend/images/keunggulan4.jpg');">
                            <div class="apartment-country">BACKUP & PEMULIHAN CEPAT</div>
                            <div class="apartment-location">Data dibackup rutin berkala dengan opsi recovery instan bila terjadi masalah.</div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="card-apartment text-center d-flex flex-column" style="background-image: url('frontend/images/keunggulan3.jpg');">
                            <div class="apartment-country">KEPATUHAN REGULASI</div>
                            <div class="apartment-location">SIMANTAP dirancang sesuai standar keamanan global (ISO 27001) dan aturan perlindungan data pribadi.</div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="card-apartment text-center d-flex flex-column" style="background-image: url('frontend/images/keunggulan4.jpg');">
                            <div class="apartment-country">PROTEKSI ANCAMAN SIBER</div>
                            <div class="apartment-location">Aplikasi ini melakukan perlindungan real-time terhadap malware, phishing, dan ransomware.</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection