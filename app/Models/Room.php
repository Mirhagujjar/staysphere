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
        'size',
        'view_type',
        'description',
        'image',
        'hero_title',
        'hero_description',
        'hero_image',
        'status',
        'is_featured',
        'total_quantity',
        'booked_quantity'
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
     * Check if enough stock is available for requested quantity.
     */
    public function hasAvailableStock($quantity = 1): bool
    {
        return $this->total_quantity > ($this->booked_quantity + $quantity - 1);
    }

    /**
     * Scope: Only rooms with available stock.
     */
    public function scopeAvailable($query)
    {
        return $query->whereRaw('total_quantity > booked_quantity');
    }

    /**
     * Scope to filter rooms by dynamic filters.
     */
    public function scopeWithFilters($query, array $filters = null)
    {
        if (!$filters) {
            return $query;
        }

        if (isset($filters['min_price'])) {
            $query->where('price', '>=', $filters['min_price']);
        }

        if (isset($filters['max_price'])) {
            $query->where('price', '<=', $filters['max_price']);
        }

        if (isset($filters['room_type'])) {
            $query->where('room_type', $filters['room_type']);
        }

        if (isset($filters['view_type'])) {
            $query->where('view_type', $filters['view_type']);
        }

        $otherFilters = array_diff_key($filters, array_flip(['min_price', 'max_price', 'room_type', 'view_type']));

        if (!empty($otherFilters)) {
            $query->where(function ($q) use ($otherFilters) {
                foreach ($otherFilters as $filterSlug => $options) {
                    if (is_array($options) && !empty($options)) {
                        $q->whereHas('filterOptions', function ($subQ) use ($options) {
                            $subQ->whereIn('filter_options.id', $options);
                        });
                    }
                }
            });
        }

        return $query;
    }

    /**
     * Filter by price range.
     */
    public function scopePriceRange($query, $min = null, $max = null)
    {
        return $query->when($min, fn($q) => $q->where('price', '>=', $min))
                     ->when($max, fn($q) => $q->where('price', '<=', $max));
    }

    public function getActiveFiltersAttribute()
    {
        return $this->filterOptions()
            ->whereHas('filter', fn($q) => $q->where('is_active', true))
            ->with('filter')
            ->get()
            ->groupBy('filter.name');
    }

    public function roomType()
    {
        return $this->belongsTo(FilterOption::class, 'room_type', 'value')
            ->whereHas('filter', fn($q) => $q->where('slug', 'room-type'));
    }

    public function viewType()
    {
        return $this->belongsTo(FilterOption::class, 'view_type', 'value')
            ->whereHas('filter', fn($q) => $q->where('slug', 'view-type'));
    }

#

    public function isBooked($checkIn, $checkOut)
    {
        return $this->reservations()
            ->where(function($q) use ($checkIn, $checkOut) {
                $q->whereBetween('check_in', [$checkIn, $checkOut])
                ->orWhereBetween('check_out', [$checkIn, $checkOut])
                ->orWhere(function ($query) use ($checkIn, $checkOut) {
                    $query->where('check_in', '<=', $checkIn)
                            ->where('check_out', '>=', $checkOut);
                });
            })->exists();
    }
    public function getAvailableStockAttribute()
    {
        return $this->total_quantity - $this->booked_quantity;
    }
}
