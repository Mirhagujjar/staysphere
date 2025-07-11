<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class FilterOption extends Model
{
    protected $fillable = [
        'filter_id', 
        'label', 
        'value', 
        'is_active',
        'order',
       'capacity',

    ];

    public function getCapacityAttribute($value)
    {
        return $value ?? 2; // Default capacity of 2 if not set
    }

    /**
     * The filter this option belongs to
     */
    public function filter(): BelongsTo
    {
        return $this->belongsTo(Filter::class);
    }

    // public function getCapacityAttribute()
    // {
    //     return $this->attributes['capacity'] ?? 1; // Default to 1 if not set
    // }
    /**
     * Rooms that have this option
     */
    public function rooms(): BelongsToMany
    {
        return $this->belongsToMany(Room::class, 'room_filter_option');
    }

    /**
     * Set value automatically if not provided
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($option) {
            if (empty($option->value)) {
                $option->value = \Illuminate\Support\Str::slug($option->label);
            }
        });
    }
}