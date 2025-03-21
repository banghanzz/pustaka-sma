@extends('layout.main')

@section('content')
    {{-- Navbar --}}
    @include('components.topNavbar')

    <div id="carouselExampleCaptions" class="carousel slide" style="height: 90vh;" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner h-100">
            <div class="carousel-item active h-100">
                <img src="{{ asset('/assets/images/pustaka-1.jpeg') }}" class="d-block w-100 h-100 object-fit-cover"
                    alt="...">
                <div class="position-absolute top-0 start-0 w-100 h-100 bg-black opacity-75"></div>
                <div class="carousel-caption d-none d-md-block position-absolute top-50 translate-middle-y">
                    <h1 class="fw-bold" style="font-size: 64px">Selamat Datang di Perpustakaan</h1>
                    <h1 style="font-size: 64px">SMA Negeri 6 Tualang</h1>
                    <p class="fs-4">Pusat Ilmu Pengetahuan dan Sumber Inspirasi Belajar</p>
                </div>
            </div>
            <div class="carousel-item h-100">
                <img src="{{ asset('/assets/images/pustaka-3.jpeg') }}" class="d-block w-100 h-100 object-fit-cover"
                    alt="...">
                <div class="position-absolute top-0 start-0 w-100 h-100 bg-black opacity-75"></div>
                <div class="carousel-caption d-none d-md-block position-absolute top-50 translate-middle-y">
                    <h1 style="font-size: 64px">Perpustakaan Pijar Cakrawala</h1>
                    <p class="fs-4">Perpustakaan SMA Negeri 3 Tualang atau sering disebut Perpustakaan Pijar Cakrawala, menjadi perpustakaan sekolah yang berdaya guna di sekolah, menjadi pusat kegiatan belajar mengajar dan terbinanya anak didik menjadi gemar membaca dan menulis.</p>
                </div>
            </div>
            <div class="carousel-item h-100">
                <img src="{{ asset('/assets/images/pustaka-2.jpeg') }}" class="d-block w-100 h-100 object-fit-cover"
                    alt="...">
                <div class="position-absolute top-0 start-0 w-100 h-100 bg-black opacity-75"></div>
                <div class="carousel-caption d-none d-md-block position-absolute top-50 translate-middle-y">
                    <h1 style="font-size: 64px">Visi Perpustakaan Pijar Cakrawala</h1>
                    <p class="fs-4">Menjadi perpustakaan yang mampu membentuk peserta didik yang beriman dan bertakwa kepada Tuhan yang Maha Esa, berbudaya melayu, unggul dalam prestasi dan peduli lingkungan, dan yang menjadi</p>
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
@endsection
