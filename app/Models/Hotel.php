<?php

namespace App\Models;

use App\Casts\MoneyCast;
use App\Enums\HotelType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hotel extends Model
{
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'type' => HotelType::class,
            'min_price_per_person' => MoneyCast::class,
        ];
    }

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class);
    }

    public function feature_items(): BelongsToMany
    {
        return $this->belongsToMany(FeatureItem::class);
    }
}
