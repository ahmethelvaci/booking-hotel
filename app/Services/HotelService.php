<?php

namespace App\Services;

use App\Contracts\Repositories\HotelRepository;
use App\Filters\HotelFilter;
use App\Contracts\Services\HotelService as HotelServiceContract;
use App\Models\Hotel;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use stdClass;

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

    public function findHotel($hotelId): null|Hotel|stdClass
    {
        return $this->repository->find($hotelId);
    }
}