<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use App\Models\Job;

use function Pest\Laravel\delete;

Route::get('/', function () {
    return view('home');
});

// index route
Route::get('/jobs', function () {
    // make the SQL query before sending it to the view
    // eager loading prevents N+1 queries
    // $jobs = Job::with('employer')->paginate(3);
    $jobs = Job::with('employer')->latest()->simplePaginate(3);
    // this paginate is for performance but doesn't have a static URL
    // $jobs = Job::with('employer')->cursorPaginate(3);

    // load the components named 'jobs' and pass it the $jobs variable
    // this is in the view folder
    return view('jobs.index', [
        'jobs' => $jobs
    ]);
});

//  create
Route::get('/jobs/create', function () {

    return view('jobs.create');
});

// show
Route::get('/jobs/{id}', function ($id) {
    $job = Job::find($id);
    return view('jobs.show', ['job' => $job]);
});

// store
Route::post('/jobs', function () {
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required', 'numeric']
    ]);

    Job::create([
        'title' => request('title'),
        'salary' => request('salary'),
        'employer_id' => 1
    ]);

    return redirect('/jobs');
});

// edit
Route::get('/jobs/{id}/edit', function ($id) {
    $job = Job::find($id);

    return view('jobs.edit', ['job' => $job]);
});

// update
Route::patch('/jobs/{id}', function ($id) {
    // validate
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required', 'numeric']
    ]);

    // authroize
    // update the job
    $job = Job::findOrFail($id);

    $job->update([
        'title' => request('title'),
        'salary' => request('salary')
    ]);

    // redirect to job page
    return redirect("/jobs/{$job->id}");
});

// destroy
Route::delete('/jobs/{id}', function ($id) {
    // authorize
    // delete the job
    Job::findOrFail($id)->delete();

    // redirect to jobs page
    return redirect('/jobs');
});

Route::get('/contact', function () {
    return view('contact');
});
