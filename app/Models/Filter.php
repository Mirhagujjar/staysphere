<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Filter extends Model
{
    protected $fillable = [
        'name',
        'type', // 'checkbox', 'dropdown'
        'slug',
        'order',
        'is_active'
    ];

    /**
     * Get all options for this filter
     */
    public function options(): HasMany
    {
        return $this->hasMany(FilterOption::class);
    }

    /**
     * Get only active options ordered by their display order
     */
    public function activeOptions()
    {
        return $this->options()->orderBy('order');
    }

    /**
     * Generate slug automatically when creating new filter
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($filter) {
            $filter->slug = \Illuminate\Support\Str::slug($filter->name);
        });
    }
}