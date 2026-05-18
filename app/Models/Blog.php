<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = 'blogs';

    protected $fillable = [
        'title',
        'slug',
        'content',
        'excerpt',
        'featured_image',
        'author_id',
        'status',
        'published_at',
        'meta_title',
        'meta_description',
        'keywords'
    ];

    protected $dates = ['published_at'];

    public function author()
    {
        return $this->belongsTo(Admin::class, 'author_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
