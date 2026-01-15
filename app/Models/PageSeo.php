<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageSeo extends Model
{
    protected $table = 'page_seo';
    
    protected $fillable = [
        'page_type',
        'page_id',
        'slug',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'og_image',
        'custom_schema',
        'no_index',
        'no_follow',
    ];

    protected $casts = [
        'no_index' => 'boolean',
        'no_follow' => 'boolean',
    ];

    /**
     * Get SEO for a specific page
     */
    public static function getForPage($pageType, $pageId = null)
    {
        return self::where('page_type', $pageType)
            ->where('page_id', $pageId)
            ->first();
    }
}
