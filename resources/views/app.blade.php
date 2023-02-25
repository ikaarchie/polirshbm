<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>.: ANTRIAN POLIKLINIK :.</title>
    <link rel="shortcut icon" type="image/x-icon" href="public/img/doctor.png">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ url('/css/app.css') }}" rel="stylesheet">
    <link href="{{ url('/css/custom.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

    <script src="{{ url('/js/app.js') }}" defer></script>
    {{-- <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</head>

<body>
    @yield('content')

    @include('popup')

    <footer class="text-light">
        &copy; 2023 IT Support, RSHBM.
    </footer>
</body>

</html>