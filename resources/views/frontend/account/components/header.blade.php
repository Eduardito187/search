<!DOCTYPE html>
<html lang="es">
    <head>
        <title>@yield('title')</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{ asset('css/font-awesome-4.7.0/css/font-awesome.css') }}">
        <link rel="stylesheet" href="{{ asset('css/login.css') }}">
        <link rel="stylesheet" href="{{ asset('css/reset-password.css') }}">
        <script src="{{ asset('js/Vue/vue.js') }}"></script>
        @yield('custom-header')
    </head>
    <body class="{{ $bodyClass }}">