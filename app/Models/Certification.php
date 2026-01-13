<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    protected $fillable = [
        'name', 'organization', 'issue_date', 'expiry_date',
        'credential_id', 'credential_url', 'certificate_file',
        'description', 'order'
    ];

    protected $casts = [
        'issue_date' => 'date',
        'expiry_date' => 'date'
    ];
}
