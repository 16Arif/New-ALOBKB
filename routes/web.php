<?php

<<<<<<< HEAD
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LogbookpetirController;
use App\Http\Controllers\LogbookperalatanController;
=======
use Illuminate\Support\Facades\Route;
>>>>>>> 03-logbookgempa
use App\Http\Controllers\PdfController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LogbookgempaController;
use App\Http\Controllers\LogbookpetirController;

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

Route::middleware(['auth'])->group(function () {
    // Route::get('home', function () {
    //     return view('pages.app.dashboard', ['type_menu' => '']);
    // })->name('home');
    Route::resource('home', DashboardController::class);
    Route::resource('user', UserController::class);
    Route::resource('logbookpetir', LogbookpetirController::class);
    Route::resource('download', PdfController::class);
<<<<<<< HEAD
    Route::resource('logbookperalatan', LogbookperalatanController::class);
=======
    Route::resource('logbookgempa', LogbookgempaController::class);
>>>>>>> 03-logbookgempa
});

Route::middleware(['guest'])->group(function(){
    Route::get('/', function () {
        return view('pages.auth.login');
    });
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
