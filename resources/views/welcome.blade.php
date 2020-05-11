<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'iWander') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- <script src="{{ asset('js/iwander.js') }}" defer></script> -->
    <!-- <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script> -->
    <script src="https://unpkg.com/jam-icons/js/jam.min.js"></script>

    <!-- <script src="{{ asset('js/iwander.js') }}" defer></script> -->

    <!-- Axios -->
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <!-- Linear Icons CSS -->
    <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/jam-icons/css/jam.min.css">

    <!-- Linear Icons JS -->
    <script src="https://cdn.linearicons.com/free/1.0.0/svgembedder.min.js"></script>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="/images/iwander-favicon.png">
</head>

<body>
    <div id="app">

    </div>

</body>

</html>
