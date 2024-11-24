<?php
namespace App\Contracts\Services;

use App\Filters\HotelFilter;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface HotelService
{
    public function listHotels(HotelFilter $filter): LengthAwarePaginator;
}