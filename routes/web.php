<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;

Route::get('test', function () {
  $job = \App\Models\Job::first();
  \App\Jobs\TranslateJob::dispatch($job);
  return 'Done';
});

Route::view('/', 'home');
Route::view('/contact', 'contact');

//  Jobs Routes
Route::get('/jobs', [JobController::class, 'index']);
Route::get('/jobs/create', [JobController::class, 'create']);
Route::post('/jobs', [JobController::class, 'store']);
Route::get('/jobs/{job}', [JobController::class, 'show'])
  ->middleware('auth');
Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])
  ->middleware('auth')
  ->can('edit', 'job');

Route::patch('/jobs/{job}', [JobController::class, 'update']);
Route::delete('/jobs{job}', [JobController::class, 'destroy']);

// Auth
Route::get('/register', [RegisterUserController::class, 'create']);
Route::post('/register', [RegisterUserController::class, 'store']);

Route::get('/login', [SessionController::class, 'create'])->name('login');
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);



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
