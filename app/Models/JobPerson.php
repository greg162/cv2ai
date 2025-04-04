<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot; // Change this import
use App\Models\AiJob as Job;
use App\Models\Person;

class JobPerson extends Pivot // Extend Pivot instead of Model
{
    protected $fillable = [
        'job_id',
        'person_id',
    ];

    protected $table = 'ai_jobs_people';

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function person()
    {
        return $this->belongsTo(Person::class);
    }
}
