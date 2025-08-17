<?php

use PHPUnit\TextUI\Help;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\HelpController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\GempaController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PetagempaController;
use App\Http\Controllers\UserprofileController;
use App\Http\Controllers\ImageprofileController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\LogbookgempaController;
use App\Http\Controllers\LogbookpetirController;
use App\Http\Controllers\LogbookperalatanController;
use App\Http\Controllers\NarasigempaController;
use App\Http\Controllers\Settings\PasswordController;

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

    Route::resource('home', DashboardController::class);
    Route::resource('logbookpetir', LogbookpetirController::class);
    Route::resource('logbookperalatan', LogbookperalatanController::class);
    Route::resource('logbookgempa', LogbookgempaController::class);
    Route::resource('gempabumi', GempaController::class);
    Route::prefix('gempabumi/custom')->name('gempabumi.custom.')->group(function () {
        Route::get('/create', [GempaController::class, 'createOnedata'])->name('create');
        Route::get('/showImport', [GempaController::class, 'showImport'])->name('showImport');
        Route::post('/importExcel', [GempaController::class, 'importExcel'])->name('importExcel');
    });
    Route::resource('narasigempa', NarasigempaController::class);
    Route::get('/narasigempa/create/{id}', [NarasigempaController::class, 'createWithId'])->name('narasigempa.createWithId');

    Route::delete('/gempabumi-batch', [GempaController::class, 'destroyBatch'])->name('gempabumi.destroyBatch');
    Route::post('/gempabumi/infografiss', [GempaController::class, 'infografiss'])->name('gempabumi.infografiss');
    Route::resource('download', PdfController::class);
    // export data 
    Route::get('export/spatie_petir', [ExportController::class, 'spatie_petir'])->name('export.spatie_petir');
    Route::get('export/spatie_peralatan', [ExportController::class, 'spatie_peralatan'])
        ->name('export.spatie_peralatan');
    Route::get('/export/spatie_gempa', [ExportController::class, 'spatie_gempa'])->name('export.spatie_gempa');
    Route::get('/export/spatie_parametergempa', [ExportController::class, 'spatie_parametergempa'])->name('export.spatie_parametergempa');

    // import data 
    Route::post('import/spatie_petir', [ImportController::class, 'spatie_petir'])->name('import.spatie_petir');
    Route::post('import/spatie_gempa', [ImportController::class, 'spatie_gempa'])->name('import.spatie_gempa');
    Route::post('import/spatie_peralatan', [ImportController::class, 'spatie_peralatan'])->name('import.spatie_peralatan');


    Route::resource('profile', UserprofileController::class)->except('index', 'show', 'create', 'store', 'destroy');
    Route::resource('imageprofile', ImageprofileController::class);
    Route::get('about', AboutController::class)->name('about');
    Route::get('help', HelpController::class)->name('help');
    // Route::get('settings/update_password', PasswordController::class)->name('user-password.update');
});

Route::middleware(['admin'])->group(function () {
    Route::resource('user', UserController::class);
});

Route::middleware(['guest'])->group(function () {
    Route::get('/', function () {
        return view('pages.auth.login');
    });
});
