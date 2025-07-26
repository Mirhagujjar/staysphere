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
        'price' => 'float',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($service) {
            if (empty($service->slug)) {
                $service->slug = Str::slug($service->title) . '-' . uniqid();
            }
        });

        // Ensure facilities is always stored as proper array
        static::saving(function ($service) {
            if (is_string($service->facilities)) {
                $service->facilities = $this->parseFacilities($service->facilities);
            }
        });
    }

    /**
     * Parse facilities from various input formats
     */
    protected function parseFacilities($input)
    {
        if (empty($input)) {
            return [];
        }

        // If it's JSON string
        if (str_starts_with($input, '[')) {
            return json_decode($input, true) ?? [];
        }

        // If it's comma-separated string
        return array_filter(array_map('trim', explode(',', $input)));
    }

    /**
     * Get formatted facilities array
     */
    public function getFormattedFacilitiesAttribute()
    {
        if (empty($this->facilities)) {
            return [];
        }

        // Ensure we have an array (handles both JSON and PHP array cases)
        $facilities = is_array($this->facilities) ? $this->facilities : [];

        // Clean each facility item
        return array_values(array_filter(array_map(function($item) {
            return trim($item, " \t\n\r\0\x0B\"'[]");
        }, $facilities)));
    }

    /**
     * Fallback for hero background image
     */
    public function getHeroImageAttribute()
    {
        return $this->hero_background ?? $this->detail_image ?? $this->thumbnail;
    }

    public function reservations()
    {
        return $this->belongsToMany(Reservation::class, 'reservation_service');
    }

    public function getPriceAttribute($value)
    {
        return (float)$value;
    }
}