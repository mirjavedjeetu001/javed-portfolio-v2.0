<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    protected $fillable = [
        'filename', 'file_path', 'parsed_data', 'is_active', 'parsed_at'
    ];

    protected $casts = [
        'parsed_data' => 'array',
        'parsed_at' => 'datetime',
        'is_active' => 'boolean'
    ];
}
