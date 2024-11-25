<?php

namespace App\Contracts\Repositories;

use App\Models\Payment;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use stdClass;

interface PaymentRepository
{
    /**
     * @return LengthAwarePaginator
     */
    public function getAll(): LengthAwarePaginator;

    /**
     * @param array $fields
     * @return null|Payment|stdClass
     */
    public function create(array $fields): null|Payment|stdClass;
}
