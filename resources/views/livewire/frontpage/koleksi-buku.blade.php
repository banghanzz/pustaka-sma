<div>
    {{-- Alert --}}
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    {{-- Jika tidak ada buku yang dipilih, tampilkan Halaman Koleksi Buku --}}
    @if (!$selectedBook)
        <!-- Form Pencarian -->
        <h2 class="mb-3 text-center">Cari Buku Di Sini</h2>
        <div class="mb-5 input-group input-group-lg">
            <span class="input-group-text h-100 bg-white border-end-0 text-dark">
                <i class="bi bi-search"></i>
            </span>
            <input type="text" wire:model.lazy="search" class="form-control border-start-0 ps-0"
                placeholder="Ketik buku yang ingin kamu cari lalu tekan Enter">
        </div>

        <!-- Filter Kategori -->
        <div class="mb-4 col-4">
            <label for="kategori" class="form-label">Filter berdasarkan Kategori:</label>
            <select id="kategori" wire:model.lazy="selectedKategori" class="form-select">
                <option value="">Semua Kategori</option>
                @foreach ($kategoriList as $kategori)
                    <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                @endforeach
            </select>
        </div>

        <!-- Koleksi Buku -->
        <div class="row px-2 grid gap-4">
            @foreach ($buku as $itemBuku)
                <div class="card p-0 border-0 shadow mb-4" style="width: 15rem;">
                    <a href="#" wire:click="selectBook({{ $itemBuku->id }})" class="text-decoration-none">
                        <img src="{{ $itemBuku->sampul ? Storage::url($itemBuku->sampul) : asset('assets/images/default_cover_book.jpg') }}"
                            onerror="this.onerror=null;this.src='{{ asset('assets/images/default_cover_book.jpg') }}';"
                            class="card-img-top" alt="{{ $itemBuku->judul }}" style="height: 20rem; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title text-dark">{{ $itemBuku->judul }}</h5>
                            <p class="card-text text-muted">Penulis: {{ $itemBuku->penulis }}</p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $buku->links() }}
        </div>
    @endif

    {{-- Jika ada buku yang dipilih, tampilkan Halaman Detail Buku --}}
    @if ($selectedBook)
        <div class="row mt-5">
            <!-- Tombol Kembali -->
            <div class="col-12 mb-5">
                <button wire:click="backToKoleksiBuku" class="btn btn-outline-primary">
                    <i class="bi bi-arrow-left"></i> Kembali ke Koleksi Buku
                </button>
            </div>

            <!-- Sampul Buku -->
            <div class="col-md-3 text-center">
                <img src="{{ $selectedBook->sampul ? Storage::url($selectedBook->sampul) : asset('assets/images/default_cover_book.jpg') }}"
                    onerror="this.onerror=null;this.src='{{ asset('assets/images/default_cover_book.jpg') }}';"
                    alt="Sampul Buku {{ $selectedBook->judul }}" class="img-fluid rounded shadow">
            </div>

            <!-- Informasi Buku -->
            <div class="col-md-9">
                <div class="card border-1 p-3">
                    <div class="card-body">
                        <h2 class="card-title text-primary mb-3">{{ $selectedBook->judul }}</h2>
                        <table class="table table-borderless m-0">
                            <tbody>
                                <tr>
                                    <th class="text-start px-0" style="width: 20%;">Penulis</th>
                                    <td class="text-center" style="width: 2%;">:</td>
                                    <td class="text-start">{{ $selectedBook->penulis }}</td>
                                </tr>
                                <tr>
                                    <th class="text-start px-0">Penerbit</th>
                                    <td class="text-center">:</td>
                                    <td class="text-start">{{ $selectedBook->penerbit }}</td>
                                </tr>
                                <tr>
                                    <th class="text-start px-0">Tahun Ajaran/Terbit</th>
                                    <td class="text-center">:</td>
                                    <td class="text-start">{{ $selectedBook->tahun_ajaran ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th class="text-start px-0">Kategori</th>
                                    <td class="text-center">:</td>
                                    <td class="text-start">{{ $selectedBook->kategori->nama }}</td>
                                </tr>
                                <tr>
                                    <th class="text-start px-0">Lokasi Rak</th>
                                    <td class="text-center">:</td>
                                    <td class="text-start">Rak {{ $selectedBook->rak->rak }} - Baris
                                        {{ $selectedBook->rak->baris }}</td>
                                </tr>
                                <tr>
                                    <th class="text-start px-0">Stok Buku</th>
                                    <td class="text-center">:</td>
                                    <td class="text-start">
                                        @if ($selectedBook->stok > 0)
                                            <span class="text-success">{{ $selectedBook->stok }} </span>
                                        @else
                                            <span class="text-danger">Kosong</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-start px-0">Sedang dipinjam</th>
                                    <td class="text-center">:</td>
                                    <td class="text-start">
                                        @if ($jumlahDipinjam > 0)
                                            <span class="text-danger">{{ $jumlahDipinjam }}</span>
                                        @else
                                            <span class="text-dark">-</span>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>


                    </div>
                </div>

                <!-- Button Tambah ke Keranjang -->
                <div class="mt-4">
                    <form action="{{ route('keranjang.add', $selectedBook->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="buku_id" value="{{ $selectedBook->id }}">
                        <button type="submit" class="btn btn-primary btn-lg w-100"
                            {{ $selectedBook->stok <= 0 ? 'disabled' : '' }}>
                            <i class="bi bi-cart-plus"></i> Tambahkan ke Keranjang Pinjaman
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>
