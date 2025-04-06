<?php

namespace App\Http\Controllers;

use App\Models\AiJob as Job;
use App\Models\Person;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Resources\JobResource;

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
        // Convert JobResource to an array
        return Inertia::render('Jobs/Show', (new JobResource($job))->toArray(request()));
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
        // Convert JobResource to an array
        return Inertia::render('Jobs/Edit', (new JobResource($job))->toArray(request()));
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
        // Detach the person from the job
        $job->people()->detach($person->id);

        return Inertia::render('Jobs/Edit', (new JobResource($job))->toArray(request()));
    }
}