<?php

namespace App\Contracts\Repositories;

use Illuminate\Support\Collection;

interface RegionRepository
{
    public function searchRegionNamesAndGetIds(string $search): Collection;
}
