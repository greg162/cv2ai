<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Person;

class JobResource extends JsonResource
{
    public function toArray($request)
    {
        $availablePeople = Person::whereDoesntHave('jobs', function ($query) {
            $query->where('ai_jobs_people.ai_job_id', $this->id);
        })->get();
        $attachedPeople = $this->people()->get();
        return [
            'job' => [
                'id' => $this->id,
                'title' => $this->title,
                'industry' => $this->industry,
                'start_date' => $this->start_date,
                'description' => $this->description,
                'status' => $this->status,
            ],
            // Ensure availablePeople and attachedPeople are correctly fetched
            'availablePeople' => $availablePeople->map(function ($person) {
                return [
                    'id' => $person->id,
                    'first_name' => $person->first_name,
                    'last_name' => $person->last_name,
                    'email' => $person->email,
                ];
            }
            ),
            'attachedPeople' => $attachedPeople->map(function ($person) {
                return [
                    'id' => $person->id,
                    'first_name' => $person->first_name,
                    'last_name' => $person->last_name,
                    'email' => $person->email,
                ];
            }),
        ];
    }
}