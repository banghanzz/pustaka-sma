<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <div class="text-center py-4">
        <img src="{{ asset('/assets/images/tut-wuri-handayani.png') }}" alt="Logo" width="60" height="60" class="d-inline-block align-text-top">
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
            <div class="sidebar-brand-text mx-3">Perpustakaan SMAN 3 Tualang</div>
        </a>
    </div>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item -->
    <li class="nav-item {{ $title === 'Dashboard' ? 'active font-weight-bold' : '' }}">
        <a class="nav-link" href="{{ url('/admin/dashboard') }}">
            <i class="bi bi-grid-1x2-fill"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <li class="nav-item {{ $title === 'Transaksi Peminjaman' ? 'active font-weight-bold' : '' }}">
        <a class="nav-link" href="{{ url('/admin/transaksi-peminjaman') }}">
            <i class="bi bi-bag-fill"></i>
            <span>Transaksi Peminjaman</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Data
    </div>

    <!-- Nav Item - Data -->
    <li class="nav-item {{ $title === 'Rak Buku' ? 'active font-weight-bold' : '' }}">
        <a class="nav-link" href="{{ url('/admin/rak') }}">
            <i class="bi bi-bookshelf"></i>
            <span>Rak Buku</span>
        </a>
    </li>
    <li class="nav-item {{ $title === 'Kategori Buku' ? 'active font-weight-bold' : '' }}">
        <a class="nav-link" href="{{ url('/admin/kategori') }}">
            <i class="bi bi-tag-fill"></i>
            <span>Kategori Buku</span>
        </a>
    </li>
    <li class="nav-item {{ $title === 'Koleksi Buku' ? 'active font-weight-bold' : '' }}">
        <a class="nav-link" href="{{ url('/admin/koleksi-buku') }}">
            <i class="bi bi-book-half"></i>
            <span>Koleksi Buku</span>
        </a>
    </li>
    <li class="nav-item {{ $title === 'Buku Rusak' ? 'active font-weight-bold' : '' }}">
        <a class="nav-link" href="{{ url('/admin/buku-rusak') }}">
            <i class="bi bi-journal-x"></i>
            <span>Buku Rusak</span>
        </a>
    </li>
    <li class="nav-item {{ $title === 'Rekapitulasi' ? 'active font-weight-bold' : '' }}">
        <a class="nav-link" href="{{ url('/admin/rekapitulasi') }}">
            <i class="bi bi-clipboard-data-fill"></i>
            <span>Rekapitulasi</span>
        </a>
    </li>
    <li class="nav-item {{ $title === 'Anggota Perpustakaan' ? 'active font-weight-bold' : '' }}">
        <a class="nav-link" href="{{ url('/admin/anggota-perpustakaan') }}">
            <i class="bi bi-person-circle"></i>
            <span>Anggota Perpustakaan</span>
        </a>
    </li>
    <li class="nav-item {{ $title === 'Tata Tertib' ? 'active font-weight-bold' : '' }}">
        <a class="nav-link" href="{{ url('/admin/tata-tertib') }}">
            <i class="bi bi-clipboard-fill"></i>
            <span>Tata Tertib</span>
        </a>
    </li>
    <li class="nav-item {{ $title === 'Visi & Misi' ? 'active font-weight-bold' : '' }}">
        <a class="nav-link" href="{{ url('/admin/visi-misi') }}">
            <i class="bi bi-clipboard-fill"></i>
            <span>Visi & Misi</span>
        </a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->