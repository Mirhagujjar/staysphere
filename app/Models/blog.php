<?php

// app/Models/Blog.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'excerpt', 'content', 'featured_image', 
        'hero_image', 'published_date', 'author', 'is_featured', 
        'status', 'meta_title', 'meta_description'
    ];

    protected $dates = ['published_date'];

    public function categories()
    {
        return $this->belongsToMany(BlogCategory::class);
    }

    public function gallery()
    {
        return $this->hasMany(BlogGallery::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
    protected $casts = [
        'published_date' => 'datetime',
    ];
}
