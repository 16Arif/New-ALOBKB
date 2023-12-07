<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['auth'])->group(function(){
    Route::get('home', function () {
        return view('pages.app.dashboard', ['type_menu' => '']);
    });

})->name('home');


Route::get('/', function () {
    return view('pages.auth.login');
});

// Route::get('/register', function () {
//     return view('pages.auth.register');
// })->name('register');

// Route::get('/forgot-password', function () {
//     return view('pages.auth.forgot-password');
// })->name('forgot-password');

// Route::get('/reset-password', function () {
//     return view('pages.auth.reset-password');
// })->name('reset-password');
