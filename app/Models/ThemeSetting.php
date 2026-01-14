<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThemeSetting extends Model
{
    protected $fillable = [
        'primary_color', 'secondary_color', 'accent_color',
        'text_color', 'background_color', 'font_family',
        'heading_font', 'dark_mode',
        // Mobile Menu Colors
        'mobile_menu_bg_from', 'mobile_menu_bg_via', 'mobile_menu_bg_to', 'mobile_menu_text',
        // Section Background Colors
        'hero_bg_color', 'about_bg_color', 'experience_bg_color', 'education_bg_color',
        'certifications_bg_color', 'skills_bg_color', 'projects_bg_color', 'awards_bg_color',
        'activities_bg_color', 'contact_bg_color',
        // Section Text Colors
        'hero_text_color', 'section_heading_color', 'section_text_color', 'contact_text_color',
        // Footer Colors
        'footer_bg_color', 'footer_text_color'
    ];

    protected $casts = [
        'dark_mode' => 'boolean'
    ];
}
