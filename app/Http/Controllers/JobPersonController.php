<?php

namespace App\Http\Controllers;

use App\Models\AiJob as Job;
use App\Models\Person;
use Illuminate\Http\Request;
use Inertia\Inertia;

class JobPersonController extends Controller
{
    /**
     * Display the job detail page with associated people.
     *
     * @param  \App\Models\Job  $job
     * @return \Inertia\Response
     */
    public function show(Job $job)
    {
        // Load the job with its associated people
        $job->load('people');
        
        // Get all people not already associated with this job (for the "add person" dropdown)
        $availablePeople = Person::whereDoesntHave('jobs', function ($query) use ($job) {
            $query->where('jobs.id', $job->id);
        })->get();
        
        return Inertia::render('Jobs/Show', [
            'job' => $job,
            'availablePeople' => $availablePeople,
        ]);
    }

    /**
     * Associate a person with a job.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\RedirectResponse
     */
    public function attachPerson(Request $request, Job $job)
    {
        $validated = $request->validate([
            'person_id' => 'required|exists:people,id',
        ]);
        
        // Attach the person to the job if not already attached
        if (!$job->people()->where('people.id', $validated['person_id'])->exists()) {
            $job->people()->attach($validated['person_id']);
        }
        
        return redirect()->route('jobs.show', $job)
            ->with('success', 'Person added to job successfully.');
    }

    /**
     * Remove a person from a job.
     *
     * @param  \App\Models\Job  $job
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\RedirectResponse
     */
    public function detachPerson(Job $job, Person $person)
    {
        $job->people()->detach($person->id);
        
        return redirect()->route('jobs.show', $job)
            ->with('success', 'Person removed from job successfully.');
    }
}