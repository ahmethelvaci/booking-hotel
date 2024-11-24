<?php
namespace App\Contracts\Services;

use App\Filters\HotelFilter;
use App\Models\Hotel;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use stdClass;

interface HotelService
{
    /**
     * @param HotelFilter $filter
     * @return LengthAwarePaginator
     */
    public function listHotels(HotelFilter $filter): LengthAwarePaginator;

    /**
     * @param int $hotelId
     * @return null|Hotel|stdClass
     */
    public function findHotel(int $hotelId): null|Hotel|stdClass;

    /**
     * @return LengthAwarePaginator
     */
    public function listFeatureItems(): LengthAwarePaginator;
}