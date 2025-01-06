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
            {{-- Nav Item --}}
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item d-flex align-items-center justify-content-center">
                    <a class="nav-link active" aria-current="page" href="#">Koleksi Buku</a>
                </li>
                <li class="nav-item d-flex align-items-center justify-content-center">
                    <a class="nav-link" href="#">Tata Tertib</a>
                </li>
                <li class="nav-item d-flex align-items-center justify-content-center">
                    <a class="nav-link" href="#">Visi & Misi</a>
                </li>
                <li class="nav-item dropdown d-flex align-items-center justify-content-center">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Peminjaman
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Keranjang Buku</a></li>
                        <li><a class="dropdown-item" href="#">Riwayat Pinjaman</a></li>
                        <li><a class="dropdown-item" href="#">Rekapitulasi</a></li>
                    </ul>
                </li>
            </ul>

            {{-- Profile Info --}}
            <ul class="navbar-nav mb-2 mb-lg-0">
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
                        <a class="dropdown-item" href="/profile">Data Profil</a>
                        <a class="dropdown-item" href="/ubahpassword">Ubah Password</a>
                        <a class="dropdown-item text-danger" href="/login">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
