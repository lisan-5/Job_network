<?php

use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\FavoriteController;


// Home page
Route::view('/', 'home');
Route::view('/contact', 'contact');

Route::controller(JobController::class)->group(function () {
//     Route::get('/jobs', 'index');
//     Route::get('/jobs/create', 'create');
//     Route::post('/jobs', 'store');
//     Route::get('/jobs/{job}', 'show');
//     Route::get('/jobs/{job}/edit', 'edit');
//     Route::patch('/jobs/{job}', 'update');
     Route::get('/jobs/{job}/delete', 'deleteConfirm');
//     Route::delete('/jobs/{job}', 'destroy');
});

// My Jobs dashboard (must be before resource routes to avoid `{job}` wildcard conflicts)
Route::get('/jobs/mine', [App\Http\Controllers\JobController::class, 'myJobs'])->middleware('auth');
// Favorite routes
Route::middleware('auth')->group(function () {
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::post('/jobs/{job}/favorite', [FavoriteController::class, 'store'])->name('favorites.store');
    Route::delete('/jobs/{job}/favorite', [FavoriteController::class, 'destroy'])->name('favorites.destroy');
});
// Resourceful routes for JobController that includes index, create, store, show, edit, update, destroy
Route::resource('jobs', JobController::class);
// Profile edit
Route::middleware('auth')->group(function () {
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
});
// Auth
Route::get('/register', [RegisteredUserController::class, 'create']);
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/login', [SessionController::class, 'create']);
Route::post('/login', [SessionController::class, 'store']);

Route::post('/logout', [SessionController::class, 'destroy']);