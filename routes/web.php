<?php

use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home');
Route::view('/contact', 'contact');

Route::resource('jobs', JobController::class);
// Route::resource('jobs', JobController::class, [
//     'only' => ['index', 'show', 'create', 'store']
// ]);
// Route::resource('jobs', JobController::class, [
//     'except' => ['edit']
// ]);
// replaces all the following routes using Resource
// Route::controller(JobController::class)->group(function () {
//     Route::get('jobs', 'index');
//     Route::get('jobs/create', 'create');
//     Route::get('jobs/{job}', 'show');
//     Route::post('jobs', 'store');
//     Route::get('jobs/{job}/edit', 'edit');
//     Route::patch('jobs/{job}', 'update');
//     Route::delete('jobs/{job}', 'destroy');
// });
