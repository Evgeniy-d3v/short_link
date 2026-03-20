<?php
use App\Presentation\AuthController;
use App\Presentation\LinksController;
use Illuminate\Support\Facades\Route;

Route::get('/auth', [AuthController::class, 'index'])->name('auth.index');
Route::post('/auth/login', [AuthController::class, 'login'])->name('auth.login');

Route::middleware('auth.user')->group(function () {
    Route::get('/', [LinksController::class, 'index'])->name('links.index');
    Route::post('/shorten', [LinksController::class, 'store'])->name('links.store');
});

Route::get('/{code}', [LinksController::class, 'redirect'])->name('links.redirect');
