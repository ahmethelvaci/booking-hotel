<?php

namespace App\Repositories\Eloquents;

use App\Contracts\Repositories\HotelRepository as HotelRepositoryContract;
use App\Contracts\Services\RegionService;
use App\Filters\HotelFilter;
use App\Models\Hotel;
use App\Models\Region;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\DB;

class HotelRepository implements HotelRepositoryContract
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function getAll(HotelFilter $filter): LengthAwarePaginator
    {
        $filters = $filter->getFilters();

        $hotels = Hotel::query();
        
        $hotels->with(['region:id,name,city_name,district_name', 'feature_items:id,name']);

        $roomsWithMinPrice = DB::table('rooms')
            ->select('hotel_id', DB::raw('MIN(price_per_person) as min_price_per_person'))
            ->groupBy('hotel_id');

        $hotels->joinSub($roomsWithMinPrice, 'rooms_with_min_price', function (JoinClause $join) {
            $join->on('hotels.id', '=', 'rooms_with_min_price.hotel_id');
        });

        if (isset($filters['name']) && $filters['name'] !== '') {
            $hotels->where('name', 'like', "%{$filters['name']}%");
        }

        if (isset($filters['type']) && $filters['type'] !== '') {
            $hotels->where('type', 'like', "{$filters['type']}");
        }

        if (isset($filters['region']) && $filters['region'] !== '') {
            $regionService = app(RegionService::class);

            $regions = $regionService->searchRegionNamesAndGetIds(name: $filters['region']);

            $hotels->whereIn('region_id', $regions);
        }

        if (isset($filters['min-price']) && $filters['min-price'] > 0) {
            $hotels->where('min_price_per_person', '>=', $filters['min-price']);
        }
        
        if (isset($filters['max-price']) && $filters['max-price'] > 0) {
            $hotels->where('min_price_per_person', "<=", $filters['max-price']);
        }


        if (isset($filters['feature_items']) && count($filters['feature_items']) > 0) {
            $hotels->whereHas('feature_items', function ($query) use ($filters) {
                $query->whereIn('id', $filters['feature_items']);
            });
        }

        $sortType = 'name';
        $sortDirection = 'asc';

        if (isset($filters['sort_direction']) && in_array($filters['sort_direction'], ['name', 'price'])) {
            $sortType = $filters['sort_type'] == 'price' ? 'min_price_per_person' : $filters['sort_type'];
        }

        if(isset($filters['sort_direction']) && in_array($filters['sort_direction'], ['asc', 'desc'])) {
            $sortDirection = $filters['sort_direction'];
        }

        $hotels->orderBy($sortType, $sortDirection);

        return $hotels->paginate();
    }
}