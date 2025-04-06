<?php

namespace App\Http\Controllers;

use App\Http\Resources\JobResource;
use App\Models\AiJob as Job;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Person;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::latest()->get();
        return Inertia::render('Jobs/Index', [
            'jobs' => $jobs
        ]);
    }

    public function create()
    {
        return Inertia::render('Jobs/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'industry' => 'required|string|max:255'
        ]);

        Job::create($validated);

        return redirect()->route('jobs.index')->with('success', 'Job created successfully');
    }

    public function edit(Job $job)
    {
        // Convert JobResource to an array
        return Inertia::render('Jobs/Edit', (new JobResource($job))->toArray(request()));
    }

    public function update(Request $request, Job $job)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'industry' => 'required|string|max:255'
        ]);

        $job->update($validated);

        return redirect()->route('jobs.index')->with('success', 'Job updated successfully');
    }

    public function destroy(Job $job)
    {
        $job->delete();

        return redirect()->route('jobs.index')->with('success', 'Job deleted successfully');
    }
}
