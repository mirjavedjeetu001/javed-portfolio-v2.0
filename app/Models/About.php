<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $table = 'about';
    
    protected $fillable = [
        'name', 'title', 'bio', 'email', 'phone', 'address', 
        'image', 'cv_file', 'years_experience', 'projects_completed',
        'technologies_used', 'countries_visited', 'clients_served', 'awards_won',
        'github_url', 'linkedin_url', 'website_url',
        'facebook', 'twitter', 'linkedin', 'github', 'instagram', 'youtube'
    ];
}
