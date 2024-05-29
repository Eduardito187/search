<!DOCTYPE html>
<html lang="es">
    <head>
        <title>@yield('title')</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{ asset('css/font-awesome-4.7.0/css/font-awesome.css') }}">
        <script src="{{ asset('js/Vue/vue.js') }}"></script>
        @yield('custom-header')
        <script>
            window.configFrontend = <?= \App\Helpers\Base\ConfigFrontend::getConfigFrontend() ?>;
        </script>
    </head>
    <body class="{{ $bodyClass }}">