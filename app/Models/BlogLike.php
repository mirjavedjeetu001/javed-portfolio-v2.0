<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogLike extends Model
{
    protected $fillable = [
        'blog_id', 'ip_address', 'user_agent'
    ];

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }
}
