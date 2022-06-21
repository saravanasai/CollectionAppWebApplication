<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>@yield('tab_tittle')</title>
    @yield('meta_tages')
    <!-- CSS files -->
    <link href="{{ asset('adminTheme/dist/css/tabler.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('adminTheme/dist/css/tabler-flags.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('adminTheme/dist/css/tabler-payments.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('adminTheme/dist/css/tabler-vendors.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('adminTheme/dist/css/demo.min.css') }}" rel="stylesheet" />



</head>

<body class="theme-light">
    <div id="app"></div>


    <!-- Tabler Core -->

    <script src={{ asset('adminTheme/dist/js/tabler.js') }} defer></script>
    <script src={{ asset('adminTheme/dist/js/demo.js') }} defer></script>
    <!-- Libs JS -->
    <script src={{ mix('js/app.js') }} defer></script>
    @yield('scripts')
</body>

</html>
