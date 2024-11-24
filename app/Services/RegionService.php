<?php

namespace App\Services;

use App\Contracts\Repositories\RegionRepository;
use App\Contracts\Services\RegionService as RegionServiceContract;
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

    public function searchRegionNamesAndGetIds(string $name): Collection
    {
        return $this->repository->searchRegionNamesAndGetIds(search: $name);
    }
}
