<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AiJob extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'start_date',
        'industry'
    ];

    protected $dates = [
        'start_date'
    ];

    public function jobPersons()
    {
        return $this->hasMany(JobPerson::class);
    }

    public function people()
    {
        return $this->belongsToMany(Person::class, 'ai_jobs_people') // Specify the correct pivot table name
            ->using(JobPerson::class)
            ->withPivot('ai_job_id', 'person_id')
            ->withTimestamps();
    }
}
