<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    //
    protected $fillable = [
        'user_id',
        'document_id',
        'filename',
        'extension',
        'mime_type',
        'size',
        'status',
        'local_path',
        'remote_path',
    ];
}
