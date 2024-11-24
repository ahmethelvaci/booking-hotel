<?php

namespace App\Contracts\Services;

use App\Models\Reservation;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use stdClass;

interface ReservationService
{
    /**
     * @return LengthAwarePaginator
     */
    public function listReservations(): LengthAwarePaginator;

    /**
     * @param array $fields
     * @return null|Reservation|stdClass
     */
    public function createNewReservation(array $fields): null|Reservation|stdClass;
}
