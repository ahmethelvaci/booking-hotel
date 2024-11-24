<?php

namespace App\Repositories\Eloquents;

use App\Contracts\Repositories\RegionRepository as RegionRepositoryContract;
use App\Filters\RegionFilter;
use App\Models\Region;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
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

    public function getAll(RegionFilter $filter): LengthAwarePaginator
    {
        $filters = $filter->getFilters();

        $regions = Region::query();

        if (isset($filters['name']) && $filters['name'] !== '') {
            $regions->where('name', 'like', "%{$filters['name']}%");
        }

        if (isset($filters['city_name']) && $filters['city_name'] !== '') {
            $regions->where('city_name', 'like', "%{$filters['city_name']}%");
        }

        if (isset($filters['district_name']) && $filters['district_name'] !== '') {
            $regions->where('district_name', 'like', "%{$filters['district_name']}%");
        }

        $regions->orderBy('district_name', 'asc');

        return $regions->paginate();
    }

    public function searchRegionNamesAndGetIds(string $search): Collection
    {
        return Region::where('name', 'like', "%{$search}%")
                ->orWhere('city_name', 'like', "%{$search}%")
                ->orWhere('district_name', 'like', "%{$search}%")
                ->get('id');
    }
}
