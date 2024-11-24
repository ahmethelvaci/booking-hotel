<?php

namespace App\Contracts\Repositories;

use App\Filters\RegionFilter;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface RegionRepository
{
    /**
     * @param RegionFilter $filter
     * @return LengthAwarePaginator
     */
    public function getAll(RegionFilter $filter): LengthAwarePaginator;

    /**
     * @param string $search
     * @return Collection
     */
    public function searchRegionNamesAndGetIds(string $search): Collection;
}
