<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title', 'description', 'image', 'url', 'github_url',
        'technologies', 'tags', 'order', 'is_featured'
    ];

    protected $casts = [
        'technologies' => 'array',
        'tags' => 'array',
        'is_featured' => 'boolean'
    ];
}
