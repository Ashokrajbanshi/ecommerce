<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.css')}}">

    @stack('css')
    <style>
        :root{
            --primary: {{ $color->primary }}
            --secondary: {{ $color->secondary }}
            --text: {{ $color->text }}
            --bg: {{ $color->bg }}
        }
        button{
            cursor: pointer;
        }
        .dropdown-menu {
            transition: all 0.3s ease;
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
        }

        .dropdown:hover .dropdown-menu,
        .dropdown-menu.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown {
            position: relative;
        }
    </style>
</head>
<body class="">
    @if(session('sweet_alert'))
    <script>console.log('SweetAlert Session Found!');</script>
@else
    <script>console.log('No SweetAlert Session Data.');</script>
@endif
@include('sweetalert::alert')

    <x-frontend-header />

    <main>
        {{ $slot }}
    </main>

    <x-frontend-footer />

    @stack('scripts')

</body>
</html>
