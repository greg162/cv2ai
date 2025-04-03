<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\JobController;
use App\Http\Controllers\PersonController;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('jobs', JobController::class);
Route::resource('people', PersonController::class);


// Managing people associated with a job
Route::post('/jobs/{job}/people', [App\Http\Controllers\JobPersonController::class, 'attachPerson'])->name('jobs.attach-person');
Route::delete('/jobs/{job}/people/{person}', [App\Http\Controllers\JobPersonController::class, 'detachPerson'])->name('jobs.detach-person');

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
