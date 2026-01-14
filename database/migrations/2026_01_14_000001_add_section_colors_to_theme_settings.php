<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('theme_settings', function (Blueprint $table) {
            // Mobile Menu Colors
            $table->string('mobile_menu_bg_from')->default('#9333ea')->after('dark_mode'); // purple-600
            $table->string('mobile_menu_bg_via')->default('#2563eb')->after('mobile_menu_bg_from'); // blue-600
            $table->string('mobile_menu_bg_to')->default('#7c3aed')->after('mobile_menu_bg_via'); // purple-700
            $table->string('mobile_menu_text')->default('#ffffff')->after('mobile_menu_bg_to');
            
            // Section Background Colors
            $table->string('hero_bg_color')->default('#667eea')->after('mobile_menu_text');
            $table->string('about_bg_color')->default('#f9fafb')->after('hero_bg_color');
            $table->string('experience_bg_color')->default('#eef2ff')->after('about_bg_color');
            $table->string('education_bg_color')->default('#fef3c7')->after('experience_bg_color');
            $table->string('certifications_bg_color')->default('#ecfdf5')->after('education_bg_color');
            $table->string('skills_bg_color')->default('#dcfce7')->after('certifications_bg_color');
            $table->string('projects_bg_color')->default('#ffedd5')->after('skills_bg_color');
            $table->string('awards_bg_color')->default('#fce7f3')->after('projects_bg_color');
            $table->string('activities_bg_color')->default('#dbeafe')->after('awards_bg_color');
            $table->string('contact_bg_color')->default('#667eea')->after('activities_bg_color');
            
            // Section Text Colors
            $table->string('hero_text_color')->default('#ffffff')->after('contact_bg_color');
            $table->string('section_heading_color')->default('#1f2937')->after('hero_text_color'); // gray-800
            $table->string('section_text_color')->default('#4b5563')->after('section_heading_color'); // gray-600
            $table->string('contact_text_color')->default('#ffffff')->after('section_text_color');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('theme_settings', function (Blueprint $table) {
            $table->dropColumn([
                'mobile_menu_bg_from',
                'mobile_menu_bg_via',
                'mobile_menu_bg_to',
                'mobile_menu_text',
                'hero_bg_color',
                'about_bg_color',
                'experience_bg_color',
                'education_bg_color',
                'certifications_bg_color',
                'skills_bg_color',
                'projects_bg_color',
                'awards_bg_color',
                'activities_bg_color',
                'contact_bg_color',
                'hero_text_color',
                'section_heading_color',
                'section_text_color',
                'contact_text_color',
            ]);
        });
    }
};
