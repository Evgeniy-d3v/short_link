<?php

use App\Presentation\AuthController;
use App\Presentation\LinksController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth.user')->group(function () {
    Route::get('/', [LinksController::class, 'index']);
    Route::post('/shorten', [LinksController::class, 'store']);
});

Route::get('/auth', [AuthController::class, 'index']);
Route::post('/auth/login', [AuthController::class, 'login']);
Route::get('/s/{code}', [LinksController::class, 'redirect']);
