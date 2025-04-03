<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\AiJob as Job;
use App\Models\Person;

class JobPerson extends Model
{
    //
    protected $fillable = [
        'job_id',
        'person_id',
    ];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }
    public function person()
    {
        return $this->belongsTo(Person::class);
    }
}
