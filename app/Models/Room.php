<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_name',
        'room_type',
        'price',
        'room_capacity',
        'facilities', // JSON field for basic facilities
        'has_view',
        'image',
        'size',
    ];

    protected $casts = [
        'has_view' => 'boolean',
        'facilities' => 'array',
    ];

    /**
     * Relationship: A room has many reservations.
     */
    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    /**
     * Relationship: Filter options assigned to this room (pivot table)
     */
    public function filterOptions(): BelongsToMany
    {
        return $this->belongsToMany(FilterOption::class, 'room_filter_option');
    }

    /**
     * Check if the room is booked for a given date range.
     */
    public function isBooked($checkIn = null, $checkOut = null): bool
    {
        if (!$checkIn || !$checkOut) {
            return false;
        }
    
        return $this->reservations()
            ->where('status', 'confirmed')
            ->where(function ($query) use ($checkIn, $checkOut) {
                $query->whereBetween('check_in', [$checkIn, $checkOut])
                      ->orWhereBetween('check_out', [$checkIn, $checkOut]);
            })
            ->exists();
    }

    /**
     * Scope to filter rooms by filter options
     */
    public function scopeWithFilters($query, array $filters = null)
    {
        return $query->when($filters, function ($query) use ($filters) {
            foreach ($filters as $filterSlug => $options) {
                if (is_array($options)) {
                    $query->whereHas('filterOptions', function ($q) use ($options) {
                        $q->whereIn('filter_options.id', $options);
                    });
                }
            }
        });
    }

    /**
     * Scope to filter by price range
     */
    public function scopePriceRange($query, $min = null, $max = null)
    {
        return $query->when($min, function ($query) use ($min) {
                $query->where('price', '>=', $min);
            })
            ->when($max, function ($query) use ($max) {
                $query->where('price', '<=', $max);
            });
    }

    /**
     * Get all active filters associated with this room
     */
    public function getActiveFiltersAttribute()
    {
        return $this->filterOptions()
            ->whereHas('filter', function ($q) {
                $q->where('is_active', true);
            })
            ->with('filter')
            ->get()
            ->groupBy('filter.name');
    }
}