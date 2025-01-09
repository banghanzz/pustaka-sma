<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Icon pada Head Title -->
    <link rel="icon" type="image/x-icon" href="{{ asset('/assets/images/tut-wuri-handayani.png') }}">

    {{-- Bootstrap CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" type="text/css">

    {{-- Bootstrap Icon CSS --}}
    <link href="/fonts/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

    {{-- DataTables CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/datatables/datatables.css') }}" />

    {{-- Livewire Style --}}
    @livewireStyles

    {{-- Custom CSS --}}
    @yield('style')

    <title>{{ $title }} - Perpustakaan SMAN 3 Tualang</title>
</head>

<body>
    @yield('content')
    
    {{-- Bootstrap JS --}}
    <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    {{-- DataTables JS --}}
    <script src="{{ asset('assets/datatables/datatables.js') }}"></script>

    {{-- Livewire Script --}}
    @livewireScripts
    
    {{-- Custom Script --}}
    @yield('script')
</body>

</html>
