<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $table = 'education';
    
    protected $fillable = [
        'degree', 'institution', 'location', 'start_date', 'end_date',
        'grade', 'description', 'order'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date'
    ];
}
