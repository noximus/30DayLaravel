<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use App\Models\Job;

Route::get('/', function () {
    return view('home');
});

Route::get('/jobs', function () {
    // make the SQL query before sending it to the view
    // eager loading prevents N+1 queries
    // $jobs = Job::with('employer')->paginate(3);
    $jobs = Job::with('employer')->simplePaginate(3);
    // this paginate is for performance but doesn't have a static URL
    // $jobs = Job::with('employer')->cursorPaginate(3);
    
    // load the components named 'jobs' and pass it the $jobs variable
    // this is in the view folder
    return view('jobs', [
        'jobs' => $jobs
    ]);
});

Route::get('/jobs/{id}', function ($id) {
    $job = Job::find($id);
    return view('job', ['job' => $job]);
});

Route::get('/contact', function () {
    return view('contact');
});
