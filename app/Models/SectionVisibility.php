<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SectionVisibility extends Model
{
    protected $table = 'section_visibility';
    
    protected $fillable = [
        'section_name',
        'section_id',
        'is_visible',
        'order'
    ];

    protected $casts = [
        'is_visible' => 'boolean'
    ];
}
