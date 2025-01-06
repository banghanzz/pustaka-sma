@extends('layout.main')

@section('content')
    @include('components.topNavbar')

    <div class="container mt-5">
        <div class="row">
            <div class="card p-0 border-0 shadow me-4 mb-4" style="width: 15rem;">
                <a href="/detail-buku" class="text-decoration-none">
                    <img src="{{ asset('assets/images/example-book.jpg') }}" 
                         class="card-img-top" 
                         alt="[Judul Buku]" 
                         style="height: 20rem; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title text-dark">[Judul Buku]</h5>
                        <p class="card-text text-muted">Penulis: [Nama Penulis]</p>
                    </div>
                </a>
            </div>
            
            <div class="card p-0 border-0 shadow me-4 mb-4" style="width: 15rem;">
                <a href="/detail-buku" class="text-decoration-none">
                    <img src="{{ asset('assets/images/example-book.jpg') }}" 
                         class="card-img-top" 
                         alt="[Judul Buku]" 
                         style="height: 20rem; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title text-dark">[Judul Buku]</h5>
                        <p class="card-text text-muted">Penulis: [Nama Penulis]</p>
                    </div>
                </a>
            </div>
            
            
        </div>
    </div>
@endsection
