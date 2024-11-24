<?php

namespace App\Repositories\Databases;

use App\Contracts\Repositories\RegionRepository as RegionRepositoryContract;
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
        return collect();
    }
}
