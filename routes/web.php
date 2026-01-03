<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilmViewController;

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

Route::get('/', function () {
    return redirect()->route('films.liste');
});

// Routes pour les vues des films
Route::get('/films/liste', [FilmViewController::class, 'liste'])->name('films.liste');
Route::get('/films/ajouter', [FilmViewController::class, 'ajouter'])->name('films.ajouter');
Route::get('/films/modifier/{id}', [FilmViewController::class, 'modifier'])->name('films.modifier');
