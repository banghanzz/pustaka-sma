@extends('layout.main')

@section('content')
    {{-- Navbar --}}
    @include('components.topNavbar')

    <div class="container mt-5">
        @livewire('koleksi-buku')
    </div>
@endsection
