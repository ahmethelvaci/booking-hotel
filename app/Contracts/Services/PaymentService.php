<?php

namespace App\Contracts\Services;

use App\Models\Payment;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use stdClass;

interface PaymentService
{
    /**
     * @return LengthAwarePaginator
     */
    public function listPayments(): LengthAwarePaginator;

    /**
     * @param array $fields
     * @return null|Payment|stdClass
     */
    public function createPayment(array $fields): null|Payment|stdClass;
}
