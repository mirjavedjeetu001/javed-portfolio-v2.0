<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryCategory extends Model
{
    protected $fillable = ['name', 'slug', 'order'];

    public function images()
    {
        return $this->hasMany(GalleryImage::class)->orderBy('order');
    }
}
