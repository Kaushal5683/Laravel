<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::all();
        return view('jobs.index', ['jobs' => $jobs]);
    }

    public function create()
    {
        return view('jobs.create');
    }

    public function store(Request $request)
{
    request()->validate([
        'title' => 'required',
        'salary' => 'required'
    ]);

    // OLD WAY: Job::create(...) -> This doesn't know who the user is.

    // NEW WAY: Get the logged-in user, access their jobs, and create one.
    // Laravel automatically fills in 'user_id' for us!
    request()->user()->jobs()->create([
        'title' => request('title'),
        'salary' => request('salary'),
    ]);

    return redirect('/jobs');
}
    public function edit(Job $job)
    {
        return view('jobs.edit', ['job' => $job]);
    }

    public function update(Job $job)
    {
        // 1. Validate
        request()->validate([
            'title' => 'required',
            'salary' => 'required'
        ]);

        // 2. Update the existing job
        $job->update([
            'title' => request('title'),
            'salary' => request('salary'),
        ]);

        // 3. Redirect
        return redirect('/jobs');
    }
    public function destroy(Job $job)
    {
        $job->delete();
        return redirect('/jobs');
    }
}