<?php

namespace App\Http\Controllers;

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
        // Get all people not already associated with this job (for the "add person" dropdown)
        $availablePeople = Person::whereDoesntHave('jobs', function ($query) use ($job) {
            $query->where('ai_jobs.id', $job->id);
        })->get();

        //Get all of the people who are already associated with this job
        $associatedPeople = $job->people()->get();
        
        return Inertia::render('Jobs/Edit', [
            'job' => $job,
            'availablePeople' => $availablePeople,
            'associatedPeople' => $associatedPeople,
        ]);
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
