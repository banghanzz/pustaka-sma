<div>
    <!-- Form Pencarian -->
    <h2 class="mb-3">Cari Buku Di Sini</h2>
    <div class="mb-5 input-group-lg">
        <input type="text" wire:model.lazy="search" class="form-control" placeholder="Ketik buku yang ingin kamu cari lalu tekan Enter">
    </div>

    <!-- Koleksi Buku -->
    <div class="row px-2 grid gap-4">
        @forelse($buku as $itemBuku)
            <div class="card p-0 border-0 shadow mb-4" style="width: 15rem;">
                <a href="/detail-buku/{{ $itemBuku->id }}" class="text-decoration-none">
                    <img src="{{ asset($itemBuku->sampul) }}" 
                         class="card-img-top" 
                         alt="{{ $itemBuku->judul }}" 
                         style="height: 20rem; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title text-dark">{{ $itemBuku->judul }}</h5>
                        <p class="card-text text-muted">Penulis: {{ $itemBuku->penulis }}</p>
                    </div>
                </a>
            </div>
        @empty
            <p class="text-center">Buku tidak ditemukan.</p>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $buku->links() }}
    </div>
</div>
