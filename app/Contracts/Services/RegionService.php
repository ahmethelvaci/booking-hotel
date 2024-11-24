<?php

namespace App\Contracts\Services;

use Illuminate\Support\Collection;

interface RegionService
{
    public function searchRegionNamesAndGetIds(string $name): Collection;
}
