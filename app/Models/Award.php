<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Award extends Model
{
    protected $fillable = [
        'title', 'organization', 'date', 'description', 'order'
    ];

    protected $casts = [
        'date' => 'date'
    ];
}
