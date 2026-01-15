<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeoSetting extends Model
{
    protected $fillable = [
        // Basic SEO
        'site_title',
        'meta_description',
        'meta_keywords',
        'meta_author',
        'canonical_url',
        'robots_txt',
        
        // Open Graph
        'og_title',
        'og_description',
        'og_image',
        'og_type',
        'og_site_name',
        
        // Twitter Card
        'twitter_card',
        'twitter_site',
        'twitter_creator',
        
        // Google Analytics
        'ga_enabled',
        'ga_measurement_id',
        'ga_property_id',
        
        // Google Search Console
        'google_site_verification',
        
        // Bing Webmaster
        'bing_site_verification',
        
        // Google AdSense
        'adsense_enabled',
        'adsense_publisher_id',
        'adsense_header_code',
        'adsense_in_article_code',
        'adsense_sidebar_code',
        'adsense_footer_code',
        'adsense_auto_ads',
        
        // Schema.org
        'schema_enabled',
        'schema_type',
        'schema_custom_json',
        
        // Sitemap
        'sitemap_enabled',
        'sitemap_last_generated',
    ];

    protected $casts = [
        'ga_enabled' => 'boolean',
        'adsense_enabled' => 'boolean',
        'adsense_auto_ads' => 'boolean',
        'schema_enabled' => 'boolean',
        'sitemap_enabled' => 'boolean',
        'sitemap_last_generated' => 'datetime',
    ];

    /**
     * Get the singleton SEO settings
     */
    public static function getSettings()
    {
        return self::first() ?? self::create([]);
    }
}
