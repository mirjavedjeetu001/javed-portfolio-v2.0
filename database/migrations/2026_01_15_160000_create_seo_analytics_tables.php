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
        // SEO Settings Table
        Schema::create('seo_settings', function (Blueprint $table) {
            $table->id();
            
            // Basic SEO
            $table->string('site_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->string('meta_author')->nullable();
            $table->string('canonical_url')->nullable();
            $table->string('robots_txt')->default('index, follow');
            
            // Open Graph
            $table->string('og_title')->nullable();
            $table->text('og_description')->nullable();
            $table->string('og_image')->nullable();
            $table->string('og_type')->default('website');
            $table->string('og_site_name')->nullable();
            
            // Twitter Card
            $table->string('twitter_card')->default('summary_large_image');
            $table->string('twitter_site')->nullable();
            $table->string('twitter_creator')->nullable();
            
            // Google Analytics
            $table->boolean('ga_enabled')->default(false);
            $table->string('ga_measurement_id')->nullable();
            $table->string('ga_property_id')->nullable();
            
            // Google Search Console
            $table->string('google_site_verification')->nullable();
            
            // Bing Webmaster
            $table->string('bing_site_verification')->nullable();
            
            // Google AdSense
            $table->boolean('adsense_enabled')->default(false);
            $table->string('adsense_publisher_id')->nullable();
            $table->text('adsense_header_code')->nullable();
            $table->text('adsense_in_article_code')->nullable();
            $table->text('adsense_sidebar_code')->nullable();
            $table->text('adsense_footer_code')->nullable();
            $table->boolean('adsense_auto_ads')->default(false);
            
            // Schema.org Structured Data
            $table->boolean('schema_enabled')->default(true);
            $table->string('schema_type')->default('Person');
            $table->text('schema_custom_json')->nullable();
            
            // Sitemap
            $table->boolean('sitemap_enabled')->default(true);
            $table->timestamp('sitemap_last_generated')->nullable();
            
            $table->timestamps();
        });

        // Visitor Analytics Table
        Schema::create('visitor_analytics', function (Blueprint $table) {
            $table->id();
            $table->string('session_id')->index();
            $table->string('ip_address')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('device_type')->nullable(); // desktop, mobile, tablet
            $table->string('browser')->nullable();
            $table->string('os')->nullable();
            $table->string('referrer')->nullable();
            $table->string('landing_page')->nullable();
            $table->string('page_url')->index();
            $table->string('page_title')->nullable();
            $table->integer('time_on_page')->default(0); // seconds
            $table->boolean('is_bounce')->default(false);
            $table->boolean('is_new_visitor')->default(true);
            $table->timestamps();
        });

        // Daily Stats Summary Table (for faster queries)
        Schema::create('visitor_daily_stats', function (Blueprint $table) {
            $table->id();
            $table->date('date')->unique();
            $table->integer('total_visits')->default(0);
            $table->integer('unique_visitors')->default(0);
            $table->integer('page_views')->default(0);
            $table->integer('bounce_count')->default(0);
            $table->integer('new_visitors')->default(0);
            $table->integer('returning_visitors')->default(0);
            $table->integer('mobile_visits')->default(0);
            $table->integer('desktop_visits')->default(0);
            $table->integer('tablet_visits')->default(0);
            $table->json('top_pages')->nullable();
            $table->json('top_referrers')->nullable();
            $table->json('countries')->nullable();
            $table->json('browsers')->nullable();
            $table->timestamps();
        });

        // Page-specific SEO Table
        Schema::create('page_seo', function (Blueprint $table) {
            $table->id();
            $table->string('page_type'); // home, blog, project, etc.
            $table->unsignedBigInteger('page_id')->nullable(); // for blog posts, projects
            $table->string('slug')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->string('og_image')->nullable();
            $table->text('custom_schema')->nullable();
            $table->boolean('no_index')->default(false);
            $table->boolean('no_follow')->default(false);
            $table->timestamps();
            
            $table->index(['page_type', 'page_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_seo');
        Schema::dropIfExists('visitor_daily_stats');
        Schema::dropIfExists('visitor_analytics');
        Schema::dropIfExists('seo_settings');
    }
};
