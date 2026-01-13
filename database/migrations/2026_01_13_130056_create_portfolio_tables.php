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
        // Settings table for site configuration
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('type')->default('text'); // text, image, color, etc.
            $table->timestamps();
        });

        // About Me section
        Schema::create('about', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('title');
            $table->text('bio');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('image')->nullable();
            $table->string('cv_file')->nullable();
            $table->integer('years_experience')->default(0);
            $table->integer('projects_completed')->default(0);
            $table->integer('technologies_used')->default(0);
            $table->integer('countries_visited')->default(0);
            $table->timestamps();
        });

        // Experience section
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->string('position');
            $table->string('company');
            $table->string('location')->nullable();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->boolean('is_current')->default(false);
            $table->text('description');
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // Skills section
        Schema::create('skill_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('skill_category_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->integer('percentage')->default(0);
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // Projects section
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('image')->nullable();
            $table->string('url')->nullable();
            $table->string('github_url')->nullable();
            $table->text('technologies')->nullable(); // JSON array of technologies
            $table->text('tags')->nullable(); // JSON array of tags
            $table->integer('order')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });

        // Education section
        Schema::create('education', function (Blueprint $table) {
            $table->id();
            $table->string('degree');
            $table->string('institution');
            $table->string('location')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('grade')->nullable();
            $table->text('description')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // Certifications section
        Schema::create('certifications', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('organization');
            $table->date('issue_date');
            $table->date('expiry_date')->nullable();
            $table->string('credential_id')->nullable();
            $table->string('credential_url')->nullable();
            $table->string('certificate_file')->nullable();
            $table->text('description')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // Entrepreneurial Activities
        Schema::create('entrepreneurships', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('role');
            $table->text('description');
            $table->string('url')->nullable();
            $table->string('image')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->boolean('is_current')->default(false);
            $table->text('tags')->nullable(); // JSON array
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // Blog Posts
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->longText('content');
            $table->string('featured_image')->nullable();
            $table->string('author')->nullable();
            $table->boolean('is_published')->default(false);
            $table->timestamp('published_at')->nullable();
            $table->integer('views')->default(0);
            $table->text('tags')->nullable(); // JSON array
            $table->timestamps();
        });

        // Gallery
        Schema::create('gallery_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        Schema::create('gallery_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gallery_category_id')->nullable()->constrained()->onDelete('set null');
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('image');
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // Contact Messages
        Schema::create('contact_messages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('subject')->nullable();
            $table->text('message');
            $table->boolean('is_read')->default(false);
            $table->timestamps();
        });

        // Social Links
        Schema::create('social_links', function (Blueprint $table) {
            $table->id();
            $table->string('platform'); // linkedin, github, twitter, etc.
            $table->string('url');
            $table->string('icon')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Theme Settings
        Schema::create('theme_settings', function (Blueprint $table) {
            $table->id();
            $table->string('primary_color')->default('#3498db');
            $table->string('secondary_color')->default('#2ecc71');
            $table->string('accent_color')->default('#e74c3c');
            $table->string('text_color')->default('#333333');
            $table->string('background_color')->default('#ffffff');
            $table->string('font_family')->default('Inter, sans-serif');
            $table->string('heading_font')->default('Poppins, sans-serif');
            $table->boolean('dark_mode')->default(false);
            $table->timestamps();
        });

        // Resumes/CVs uploaded
        Schema::create('resumes', function (Blueprint $table) {
            $table->id();
            $table->string('filename');
            $table->string('file_path');
            $table->text('parsed_data')->nullable(); // JSON data from AI parsing
            $table->boolean('is_active')->default(false);
            $table->timestamp('parsed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resumes');
        Schema::dropIfExists('theme_settings');
        Schema::dropIfExists('social_links');
        Schema::dropIfExists('contact_messages');
        Schema::dropIfExists('gallery_images');
        Schema::dropIfExists('gallery_categories');
        Schema::dropIfExists('blog_posts');
        Schema::dropIfExists('entrepreneurships');
        Schema::dropIfExists('certifications');
        Schema::dropIfExists('education');
        Schema::dropIfExists('projects');
        Schema::dropIfExists('skills');
        Schema::dropIfExists('skill_categories');
        Schema::dropIfExists('experiences');
        Schema::dropIfExists('about');
        Schema::dropIfExists('settings');
    }
};
