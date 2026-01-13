<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entrepreneurship extends Model
{
    protected $fillable = [
        'name', 'role', 'description', 'url', 'image',
        'start_date', 'end_date', 'is_current', 'tags', 'order'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_current' => 'boolean',
        'tags' => 'array'
    ];
}
