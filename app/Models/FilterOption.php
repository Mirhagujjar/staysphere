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
        'order'
    ];

    /**
     * The filter this option belongs to
     */
    public function filter(): BelongsTo
    {
        return $this->belongsTo(Filter::class);
    }

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