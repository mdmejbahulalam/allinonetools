<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tool extends Model
{
    protected $fillable = ['category_id', 'title', 'slug', 'description', 'keywords', 'meta_title', 'meta_description', 'blade_view', 'status', 'views'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function faqs()
    {
        return $this->hasMany(Faq::class);
    }

    public function views()
    {
        return $this->hasMany(ToolView::class);
    }
}
