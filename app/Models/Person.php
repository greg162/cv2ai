<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\AiJob as Job;

class Person extends Model
{
    //
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'address_line_1',
        'address_line_2',
        'city',
        'state',
        'zip',
        'country'
    ];
    
    protected $table = 'people';

    public function files()
    {
        return $this->hasMany(File::class);
    }
    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function jobPersons()
    {
        return $this->belongsToMany(JobPerson::class)
            ->withPivot('job_id', 'person_id')
            ->withTimestamps();
    }

    public function jobs()
    {
        return $this->belongsToMany(Job::class, 'ai_jobs_people') // Specify the correct pivot table name
            ->using(JobPerson::class)
            ->withPivot('job_id', 'person_id')
            ->withTimestamps();
    }
}
