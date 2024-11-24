<?php

namespace App\Services;

use App\Contracts\Repositories\HotelRepository;
use App\Filters\HotelFilter;
use App\Contracts\Services\HotelService as HotelServiceContract;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class HotelService implements HotelServiceContract
{
    public function __construct(protected HotelRepository $repository)
    {
        // 
    }

    public function listHotels(HotelFilter $filter): LengthAwarePaginator
    {
        return $this->repository->getAll($filter);
    }
}