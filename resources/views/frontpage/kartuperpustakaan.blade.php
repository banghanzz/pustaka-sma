@extends('layout.main')

@section('content')
    {{-- Navbar --}}
    @include('components.topNavbar')

    <div class="container mt-5">
        @livewire('kartu-perpustakaan')
    </div>
@endsection
