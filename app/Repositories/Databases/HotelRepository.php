<?php

namespace App\Repositories\Databases;

use App\Contracts\Repositories\HotelRepository as HotelRepositoryContract;
use App\Filters\HotelFilter;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

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
        //
    }
}
