<?php
namespace App\Contracts\Repositories;

use App\Filters\HotelFilter;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface HotelRepository
{
    /**
     * @param HotelFilter $filter
     * @return Collection
     */
    public function getAll(HotelFilter $filter): LengthAwarePaginator;
}