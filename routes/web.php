<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/Accueil', function () {
    return view('accueil');
})->name('Accueil');
