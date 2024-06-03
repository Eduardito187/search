<!DOCTYPE html>
<html lang="es">
    <head>
        <title>@yield('title')</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{ asset('css/font-awesome-4.7.0/css/font-awesome.css') }}">
        <link rel="stylesheet" href="{{ asset('css/bootstrap/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/ApexChart/apexcharts.min.css') }}">
        <script src="{{ asset('js/Vue/vue.js') }}"></script>
        <script src="{{ asset('js/Axios/axios.min.js') }}"></script>
        <script>
            window.configFrontend = <?= json_encode(\App\Helpers\Base\ConfigFrontend::getConfigFrontend()); ?>;
        </script>
        @yield('custom-header')
    </head>
    <body class="{{ $bodyClass }}">