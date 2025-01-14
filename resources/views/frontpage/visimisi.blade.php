@extends('layout.main')

@section('content')
    {{-- Navbar --}}
    @include('components.topNavbar')

    <div class="container mt-5">
        {{-- Judul Halaman --}}
        <h2 class="mb-5 text-center">Visi & Misi</h2>

        {{-- Card Visi & Misi --}}
        @foreach ($visi_misi as $item)
            <div class="card mb-3">
                <h5 class="card-header text-center">Visi</h5>
                <div class="card-body">
                    <p class="card-text">{!! nl2br(e($item->visi)) !!}</p>
                </div>
            </div>
            <div class="card mb-3">
                <h5 class="card-header text-center">Misi</h5>
                <div class="card-body">
                    <p class="card-text">{!! nl2br(e($item->misi)) !!}</p>
                </div>
            </div>
        @endforeach
    </div>
@endsection
