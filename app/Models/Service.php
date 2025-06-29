<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'long_description',
        'price',
        'thumbnail',
        'detail_image',
        'modal_button_text',
        'facilities',
        'modal_fields',
        'hero_title',
        'hero_subtitle',
        'hero_background',
    ];


    
    protected $casts = [
        'facilities' => 'array',
        'modal_fields' => 'array',
    ];

    /**
     * Boot method to automatically create a slug.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($service) {
            if (empty($service->slug)) {
                $service->slug = Str::slug($service->title) . '-' . uniqid();
            }
        });
    }

    /**
     * Accessor: fallback for hero background image
     */
    public function getHeroImageAttribute()
    {
        return $this->hero_background ?? $this->detail_image ?? $this->thumbnail;
    }
}
