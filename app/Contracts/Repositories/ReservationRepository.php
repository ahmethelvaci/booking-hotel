<?php

namespace App\Contracts\Repositories;

use App\Models\Reservation;
use stdClass;

interface ReservationRepository
{
    /**
     * @param array $fields
     * @return null|Reservation|stdClass
     */
    public function create(array $fields): null|Reservation|stdClass;
}
