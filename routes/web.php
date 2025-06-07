<?php

use App\Http\Controllers\ProductController;
use App\Http\Middleware\AdminMiddleware;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;


Route::view('/', 'home')->name('home');
Route::view('/cardapio', 'cardapio')->name('cardapio');
Route::view('/carrinho', 'carrinho')->name('carrinho');
Route::view('/politica_privacidade', 'politica_privacidade')->name('politica_privacidade');

Route::get('/products/{product}', [ProductController::class, 'show'])->name('product');

// Routes with auth Middleware

Route::view('conta', 'conta')->middleware(['auth'])->name('conta');

// Routes with auth + admin Middleware

Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::view('/dashboard', 'adm_home')->name('dashboard');
    Route::view('/pratos', 'adm_pratos')->name('pratos');
    Route::view('/usuarios','adm_usuarios')->name('usuarios');
});

// Route::view('dashboard', 'dashboard')->middleware(['auth', AdminMiddleware::class])->name('dashboard');

// Routes with guest Middleware

Route::middleware(['guest'])->group(function () {
    Route::view('/entrar', 'login')->name('entrar');
    Route::view('/registro', 'registro')->name('registro');
});


# Not me

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__ . '/auth.php';
