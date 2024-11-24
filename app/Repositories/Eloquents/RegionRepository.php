<?php

namespace App\Repositories\Eloquents;

use App\Contracts\Repositories\RegionRepository as RegionRepositoryContract;
use App\Models\Region;
use Illuminate\Support\Collection;

class RegionRepository implements RegionRepositoryContract
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function searchRegionNamesAndGetIds(string $search): Collection
    {
        return Region::where('name', 'like', "%{$search}%")
                ->orWhere('city_name', 'like', "%{$search}%")
                ->orWhere('district_name', 'like', "%{$search}%")
                ->get('id');
    }
}
