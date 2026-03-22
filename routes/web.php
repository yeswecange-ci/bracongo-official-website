<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PageController;

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard');
    Route::get('/pages', [PageController::class, 'index'])->name('pages.index');
    Route::get('/pages/create', [PageController::class, 'create'])->name('pages.create');
});

Route::get('/Accueil', function () {
    return view('accueil');
})->name('Accueil');

Route::get('/histoire', function () {
    return view('histoire');
})->name('histoire');

Route::get('/Notre-Histoire', function () {
    return view('histoire');
})->name('Histoire');

Route::get('/Nos-marques', function () {
    return view('marques.marque');
})->name('marque');

Route::get('/Nos-marques-bieres', function () {
    return view('marques.bieres');
})->name('bieres');

Route::get('/Nos-marques-bieres-beaufort', function () {
    return view('marques.beaufort');
})->name('bieres.beaufort');

Route::get('/Actualités-et-evenements', function () {
    return view('actualites');
})->name('actualites');

Route::get('/Carriere', function () {
    return view('carriere');
})->name('carriere');

Route::get('/Contact', function () {
    return view('contact');
})->name('contact');

Route::get('Bracongo-pro', function () {
    return view('pro');
})->name('pro');