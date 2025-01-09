<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Icon pada Head Title -->
    <link rel="icon" type="image/x-icon" href="{{ asset('/assets/images/tut-wuri-handayani.png') }}">

    <!-- Custom styles for this template-->
    <link href="{{ asset('assets/sbadmin/css/sb-admin-2.min.css') }}" rel="stylesheet">

    {{-- Livewire Style --}}
    @livewireStyles

    {{-- Custom CSS --}}
    @yield('style')

    <title>{{ $title }} - Admin Perpustakaan SMAN 3 Tualang</title>
</head>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        @yield('content')
    </div>
    
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('assets/sbadmin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('assets/sbadmin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('assets/sbadmin/js/sb-admin-2.min.js') }}"></script>

    {{-- Livewire Script --}}
    @livewireScripts
    
    {{-- Custom Script --}}
    @yield('script')
</body>
</html>