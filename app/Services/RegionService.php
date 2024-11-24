<?php

namespace App\Services;

use App\Contracts\Repositories\RegionRepository;
use App\Contracts\Services\RegionService as RegionServiceContract;
use App\Filters\RegionFilter;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class RegionService implements RegionServiceContract
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected RegionRepository $repository)
    {
        //
    }

    public function listRegions(RegionFilter $filter): LengthAwarePaginator
    {
        return $this->repository->getAll($filter);
    }

    public function searchRegionNamesAndGetIds(string $name): Collection
    {
        return $this->repository->searchRegionNamesAndGetIds(search: $name);
    }
}
