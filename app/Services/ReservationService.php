<?php

namespace App\Services;

use App\Contracts\Repositories\ReservationRepository;
use App\Contracts\Services\ReservationService as ReservationServiceContract;
use App\Models\Reservation;
use stdClass;

class ReservationService implements ReservationServiceContract
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected ReservationRepository $repository)
    {
        //
    }

    public function createNewReservation(array $fields): null|Reservation|stdClass
    {
        return $this->repository->create($fields);
    }
}
