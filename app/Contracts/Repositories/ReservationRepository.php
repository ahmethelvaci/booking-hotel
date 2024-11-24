<?php

namespace App\Contracts\Repositories;

use App\Models\Reservation;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use stdClass;

interface ReservationRepository
{
    /**
     * @return LengthAwarePaginator
     */
    public function getAll(): LengthAwarePaginator;

    /**
     * @param array $fields
     * @return null|Reservation|stdClass
     */
    public function create(array $fields): null|Reservation|stdClass;
}
