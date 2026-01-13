<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $fillable = [
        'label',
        'url',
        'section_id',
        'order',
        'is_visible'
    ];

    protected $casts = [
        'is_visible' => 'boolean'
    ];
}
