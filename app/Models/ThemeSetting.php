<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThemeSetting extends Model
{
    protected $fillable = [
        'primary_color', 'secondary_color', 'accent_color',
        'text_color', 'background_color', 'font_family',
        'heading_font', 'dark_mode'
    ];

    protected $casts = [
        'dark_mode' => 'boolean'
    ];
}
