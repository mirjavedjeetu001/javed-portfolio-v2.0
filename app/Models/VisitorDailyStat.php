<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitorDailyStat extends Model
{
    protected $fillable = [
        'date',
        'total_visits',
        'unique_visitors',
        'page_views',
        'bounce_count',
        'new_visitors',
        'returning_visitors',
        'mobile_visits',
        'desktop_visits',
        'tablet_visits',
        'top_pages',
        'top_referrers',
        'countries',
        'browsers',
    ];

    protected $casts = [
        'date' => 'date',
        'top_pages' => 'array',
        'top_referrers' => 'array',
        'countries' => 'array',
        'browsers' => 'array',
    ];
}
