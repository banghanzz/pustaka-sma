<div>
    {{-- Jika tidak ada buku yang dipilih, tampilkan Halaman Koleksi Buku --}}
    @if (!$selectedBook)
        <!-- Form Pencarian -->
        <h2 class="mb-3 text-center">Cari Buku Di Sini</h2>
        <div class="mb-5 input-group input-group-lg">
            <span class="input-group-text h-100 bg-white border-end-0 text-dark">
                <i class="bi bi-search"></i>
            </span>
            <input type="text" wire:model="search" class="form-control border-start-0 ps-0"
                placeholder="Ketik buku yang ingin kamu cari lalu tekan Enter">
        </div>

        <!-- Koleksi Buku -->
        <div class="row px-2 grid gap-4">
            @foreach ($buku as $itemBuku)
                <div class="card p-0 border-0 shadow mb-4" style="width: 15rem;">
                    <a href="#" wire:click="selectBook({{ $itemBuku->id }})" class="text-decoration-none">
                        <img src="{{ asset($itemBuku->sampul) }}" class="card-img-top" alt="{{ $itemBuku->judul }}"
                            style="height: 20rem; object-fit: cover;">
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
                <img src="{{ asset($selectedBook->sampul) }}" alt="Sampul Buku {{ $selectedBook->judul }}"
                    class="img-fluid w-100 rounded shadow">
            </div>

            <!-- Informasi Buku -->
            <div class="col-md-9">
                <div class="card border-1 p-3">
                    <div class="card-body">
                        <h2 class="card-title text-primary mb-3">{{ $selectedBook->judul }}</h2>
                        <table class="table table-borderless m-0">
                            <tbody>
                                <tr>
                                    <th class="text-start px-0" style="width: 16%;">Penulis</th>
                                    <td class="text-center" style="width: 2%;">:</td>
                                    <td class="text-start">{{ $selectedBook->penulis }}</td>
                                </tr>
                                <tr>
                                    <th class="text-start px-0">Kategori</th>
                                    <td class="text-center">:</td>
                                    <td class="text-start">{{ $selectedBook->kategori->nama }}</td>
                                </tr>
                                <tr>
                                    <th class="text-start px-0">Lokasi Rak</th>
                                    <td class="text-center">:</td>
                                    <td class="text-start">{{ $selectedBook->rak->rak }}</td>
                                </tr>
                                <tr>
                                    <th class="text-start px-0">Stok Tersedia</th>
                                    <td class="text-center">:</td>
                                    <td class="text-start">
                                        @if ($selectedBook->stok > 0)
                                            <span class="text-success">{{ $selectedBook->stok }}</span>
                                        @else
                                            <span class="text-danger">Kosong</span>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        
                    </div>
                </div>

                <!-- Button Tambah ke Keranjang -->
                <div class="mt-4">
                    {{-- <form action="{{ route('cart.add', $selectedBook->id) }}" method="POST"> --}}
                        @csrf
                        <button type="submit" class="btn btn-primary btn-lg w-100" {{ $selectedBook->stok <= 0 ? 'disabled' : '' }}>
                            <i class="bi bi-cart-plus"></i> Tambahkan ke Keranjang Pinjaman
                        </button>
                    </form>
                </div>

            </div>
        </div>
    @endif
</div>
