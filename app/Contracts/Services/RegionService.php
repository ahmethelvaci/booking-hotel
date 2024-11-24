<?php

namespace App\Contracts\Services;

use App\Filters\RegionFilter;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface RegionService
{
    /**
     * @param RegionFilter $filter
     * @return LengthAwarePaginator
     */
    public function listRegions(RegionFilter $filter): LengthAwarePaginator;

    /**
     * @param string $name
     * @return Collection
     */
    public function searchRegionNamesAndGetIds(string $name): Collection;
}
