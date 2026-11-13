<?php

use App\Http\Controllers\AdatbazisController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DiagramController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\FilmController;
use App\Models\Film;
use App\Models\Mozi;
use Illuminate\Support\Facades\Route;

// Főoldal (Blade, Bootstrap téma)
Route::get('/', function () {
    return view('home', [
        'filmDb' => Film::count(),
        'moziDb' => Mozi::count(),
        'mufajDb' => Film::whereNotNull('mufaj')->distinct()->count('mufaj'),
    ]);
})->name('home');

// Mindenki látja
Route::get('/adatbazis', [AdatbazisController::class, 'index'])->name('adatbazis');
Route::get('/diagram', [DiagramController::class, 'index'])->name('diagram');
Route::get('/contact', [ContactController::class, 'create'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Csak bejelentkezett felhasználó
Route::middleware(['auth'])->group(function () {
    Route::get('/messages', [MessageController::class, 'index'])->name('messages');
});

// Csak admin: CRUD a filmek táblához
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('filmek', FilmController::class)
        ->parameters(['filmek' => 'film'])
        ->except(['show']);
});

// IDEIGLENES: táblák létrehozása a tárhelyen (nincs SSH). Csak a .env-ben beállított MIGRATE_KEY-vel működik.
// Használat után töröld ezt az útvonalat és a MIGRATE_KEY sort!
Route::get('/run-migrations', function (\Illuminate\Http\Request $request) {
    $kulcs = env('MIGRATE_KEY');
    abort_unless($kulcs && hash_equals($kulcs, (string) $request->query('key')), 404);
    return \Illuminate\Support\Facades\Artisan::call('migrate:fresh', ['--seed' => true, '--force' => true]);
});

// A kezdőcsomag (Inertia) dashboard-ja és az autentikáció útvonalai
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia\Inertia::render('dashboard');
    })->name('dashboard');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
