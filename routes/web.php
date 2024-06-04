<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

$routes = [
    '/dashboard' => 'dashboard',
    '/indexes' => 'indexes',
    '/settings' => 'settings',
    '/users' => 'users',
    '/home' => 'home',
    '/' => 'welcome',
];

// Asociar las rutas a las vistas
foreach ($routes as $route => $view) {
    Route::get($route, function () {
        return view('frontend.account.home.home')->with('bodyClass', 'body-home');
    });
}

Route::get('/login', function () {
    return response($_COOKIE["customer_backend"]);
    return view('frontend.account.login.login')->with('bodyClass', 'body-login');
});

Route::get('/restore-password', function () {
    return view('frontend.account.reset.reset')->with('bodyClass', 'body-restore');
});