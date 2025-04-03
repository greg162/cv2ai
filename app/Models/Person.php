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
        return $this->belongsToMany(Job::class, 'job_person')
            ->withTimestamps();
    }
}
