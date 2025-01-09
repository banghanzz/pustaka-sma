@extends('layout.main')

@section('content')
    {{-- Navbar --}}
    @include('components.topNavbar')

    <div class="container mt-5">
        {{-- Judul Halaman --}}
        <h2 class="mb-5 text-center">Tata Tertib</h2>

        {{-- Card Tata Tertib --}}
        @foreach ($tata_tertib as $item_tata_tertib)
            <div class="card mb-3">
                <h5 class="card-header">{{ $item_tata_tertib->judul_tata_tertib }}</h5>
                <div class="card-body">
                    <p class="card-text">{!! nl2br(e($item_tata_tertib->isi_tata_tertib)) !!}</p>
                </div>
            </div>
        @endforeach
    </div>
@endsection
