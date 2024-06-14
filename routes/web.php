<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\PasswordResetController;

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
    '/home' => 'welcome',
    '/support' => 'support',
    '/contacts' => 'contacts',
    '/notifications' => 'notifications',
    '/account' => 'account',
    '/team' => 'team',
    '/keys' => 'keys',
    '/application' => 'application',
    '/infraestructura' => 'infraestructura'
];

// Asociar las rutas a las vistas
foreach ($routes as $route => $view) {
    Route::get($route, function () {
        if (!isset($_COOKIE["customer_backend"])) {
            return redirect('/login');
        }

        return view('frontend.account.home.home')->with('bodyClass', 'body-home');
    });
}

Route::get('/login', function () {
    if (isset($_COOKIE["customer_backend"])) {
        return redirect('/home');
    }

    return view('frontend.account.login.login')->with('bodyClass', 'body-login');
});

Route::get('/restore-password', function () {
    if (isset($_COOKIE["customer_backend"])) {
        return redirect('/home');
    }

    return view('frontend.account.reset.reset')->with('bodyClass', 'body-restore');
});

Route::get('password/reset/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [PasswordResetController::class, 'reset'])->name('password.update');