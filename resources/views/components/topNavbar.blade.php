<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
        {{-- Logo --}}
        <a class="navbar-brand" href="#">
            <img src="{{ asset('/assets/images/tut-wuri-handayani.png') }}" alt="Logo" width="48" height="48"
                class="d-inline-block align-text-top">
            <a class="navbar-brand bg-transparent fw-semibold me-5" href="/">Perpustakaan SMAN 3 Tualang</a>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarSupportedContent">
            {{-- Left Side Nav Item --}}
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item d-flex align-items-center justify-content-center">
                    <a class="nav-link {{ $title === 'Koleksi Buku' ? 'active fw-semibold' : '' }}" aria-current="page" href="{{ url('/') }}">Koleksi Buku</a>
                </li>
                <li class="nav-item d-flex align-items-center justify-content-center">
                    <a class="nav-link {{ $title === 'Tata Tertib' ? 'active fw-semibold' : '' }}" href="{{ url('/tata-tertib') }}">Tata Tertib</a>
                </li>
                <li class="nav-item d-flex align-items-center justify-content-center">
                    <a class="nav-link {{ $title === 'Visi & Misi' ? 'active fw-semibold' : '' }}" href="{{ url('/visi-misi') }}">Visi & Misi</a>
                </li>
            </ul>

            {{-- Right Side Nav Item --}}
            <ul class="navbar-nav mb-2 mb-lg-0">
                {{-- Keranjang --}}
                <li class="nav-item d-flex align-items-center justify-content-center">
                    <a class="nav-link d-flex align-items-center {{ $title === 'Keranjang' ? 'active fw-semibold' : '' }}" href="{{ url('/keranjang') }}"><i class="bi {{ $title === 'Keranjang' ? 'bi-cart-fill' : 'bi-cart' }} fs-4 me-1"></i>Keranjang</a>
                </li>

                {{-- Profile Info --}}
                <li class="nav-item dropdown d-flex align-items-center justify-content-center">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="text-center">
                            <img src="{{ asset('assets/images/avatar.jpg') }}" class="rounded-circle" alt="Logo" width="48"
                                height="48" />
                        </div>
                        <div class="mx-3">
                            <p class="fs-6 fw-medium p-0 m-0">
                                Nama Pengguna
                            </p>
                            <p class="fw-light p-0 m-0" style="font-size: 12px">
                                Role Pengguna
                            </p>
                        </div>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ url('/kartu-perpustakaan') }}">Kartu Perpustakaan</a>
                        <a class="dropdown-item" href="{{ url('/riwayat') }}">Riwayat Pinjaman</a>
                        <a class="dropdown-item" href="{{ url('/rekapitulasi') }}">Rekapitulasi</a>
                        <a class="dropdown-item" href="/ubahpassword">Ubah Password</a>
                        <a class="dropdown-item text-danger" href="/login">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
