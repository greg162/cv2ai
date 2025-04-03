<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    //
    protected $fillable = [
        'person_id',
        'document_type_id',
        'settings',
        'result',
        'status',
        'error',
    ];
    protected $casts = [
        'settings' => 'array',
        'result' => 'array',
    ];
    protected $attributes = [
        'status' => 'pending',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
