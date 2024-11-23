<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class FeatureItem extends Model
{
    public function hotels(): BelongsToMany
    {
        return $this->belongsToMany(Hotel::class);
    }
}
