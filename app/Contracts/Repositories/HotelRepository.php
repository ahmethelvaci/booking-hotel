<?php
namespace App\Contracts\Repositories;

use App\Filters\HotelFilter;
use App\Models\Hotel;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use stdClass;

interface HotelRepository
{
    /**
     * @param HotelFilter $filter
     * @return LengthAwarePaginator
     */
    public function getAll(HotelFilter $filter): LengthAwarePaginator;

    /**
     * @param int $hotelId
     * @return null|Hotel|stdClass
     */
    public function find(int $hotelId): null|Hotel|stdClass;

    /**
     * @return LengthAwarePaginator
     */
    public function getFeatureItems(): LengthAwarePaginator;
}