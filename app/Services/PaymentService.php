<?php

namespace App\Services;

use App\Contracts\Repositories\PaymentRepository;
use App\Contracts\Services\PaymentService as PaymentServiceContract;
use App\Models\Payment;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use stdClass;

class PaymentService implements PaymentServiceContract
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected PaymentRepository $repository)
    {
        //
    }

    public function listPayments(): LengthAwarePaginator
    {
        return $this->repository->getAll();
    }

    public function createPayment(array $fields): null|Payment|stdClass
    {
        if($this->getPayment($fields)) {
            return $this->repository->create($fields);
        }

        throw new Exception("No payment received");
    }

    protected function getPayment($fields): bool
    {
        return true;
    }
}
