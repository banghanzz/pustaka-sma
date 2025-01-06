<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- Bootstrap CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" type="text/css">


    <title>Perpustakaan SMAN 3 Tualang</title>
</head>

<body>
    @yield('content')
    
    {{-- Bootstrap JS --}}
    <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
