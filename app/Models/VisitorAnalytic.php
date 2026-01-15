<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitorAnalytic extends Model
{
    protected $table = 'visitor_analytics';
    
    protected $fillable = [
        'session_id',
        'ip_address',
        'country',
        'city',
        'device_type',
        'browser',
        'os',
        'referrer',
        'landing_page',
        'page_url',
        'page_title',
        'time_on_page',
        'is_bounce',
        'is_new_visitor',
    ];

    protected $casts = [
        'is_bounce' => 'boolean',
        'is_new_visitor' => 'boolean',
    ];
}
