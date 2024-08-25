<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Job;

class JobController extends Controller
{
    public function index()
    {
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
    }
    public function create()
    {
        return view('jobs.create');
    }
    public function show(Job $job)
    {
        return view('jobs.show', ['job' => $job]);
    }
    // store
    public function store()
    {
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
    }
    // edit
    public function edit(Job $job)
    {
        return view('jobs.edit', ['job' => $job]);
    }
    // update
    public function update(Job $job)
    {
        request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required', 'numeric']
        ]);

        $job->update([
            'title' => request('title'),
            'salary' => request('salary')
        ]);

        return redirect("/jobs/{$job->id}");
    }
    // destroy
    public function destroy(Job $job)
    {
        $job->delete();
        return redirect('/jobs');
    }
}
