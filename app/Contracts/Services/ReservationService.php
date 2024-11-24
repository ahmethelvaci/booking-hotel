<?php

namespace App\Contracts\Services;

use App\Models\Reservation;
use stdClass;

interface ReservationService
{
    /**
     * @param array $fields
     * @return null|Reservation|stdClass
     */
    public function createNewReservation(array $fields): null|Reservation|stdClass;
}
