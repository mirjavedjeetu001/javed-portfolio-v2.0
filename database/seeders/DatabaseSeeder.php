<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\ThemeSetting;
use App\Models\SocialLink;
use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create default theme settings
        ThemeSetting::create([
            'primary_color' => '#3498db',
            'secondary_color' => '#2ecc71',
            'accent_color' => '#e74c3c',
            'text_color' => '#333333',
            'background_color' => '#ffffff',
            'font_family' => 'Inter, sans-serif',
            'heading_font' => 'Poppins, sans-serif',
            'dark_mode' => false,
        ]);

        // Create social links
        $socialLinks = [
            ['platform' => 'LinkedIn', 'url' => 'https://www.linkedin.com', 'icon' => 'fab fa-linkedin', 'order' => 1, 'is_active' => true],
            ['platform' => 'GitHub', 'url' => 'https://github.com', 'icon' => 'fab fa-github', 'order' => 2, 'is_active' => true],
            ['platform' => 'Twitter', 'url' => 'https://twitter.com', 'icon' => 'fab fa-twitter', 'order' => 3, 'is_active' => true],
            ['platform' => 'Facebook', 'url' => 'https://facebook.com', 'icon' => 'fab fa-facebook', 'order' => 4, 'is_active' => true],
        ];

        foreach ($socialLinks as $link) {
            SocialLink::create($link);
        }

        // Create default settings
        $settings = [
            ['key' => 'site_name', 'value' => 'My Portfolio', 'type' => 'text'],
            ['key' => 'site_tagline', 'value' => 'Professional Portfolio', 'type' => 'text'],
            ['key' => 'site_description', 'value' => 'Welcome to my professional portfolio', 'type' => 'text'],
            ['key' => 'contact_email', 'value' => 'contact@example.com', 'type' => 'text'],
            ['key' => 'google_analytics', 'value' => '', 'type' => 'text'],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}
