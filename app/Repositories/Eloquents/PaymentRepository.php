<?php

namespace App\Repositories\Eloquents;

use App\Contracts\Repositories\PaymentRepository as PaymentRepositoryContract;
use App\Models\Payment;
use App\Models\Reservation;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class PaymentRepository implements PaymentRepositoryContract
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function getAll(): LengthAwarePaginator
    {
        $payments = Payment::paginate();

        return $payments;
    }

    public function create(array $fields): null|Payment
    {
        $payment = new Payment();

        DB::beginTransaction();
        try {
            $reservation = Reservation::find($fields['reservation_id']);

            $payment->reservation_id = $fields['reservation_id'];
            $payment->amount = $reservation->amount;
            $payment->is_success = 1;
            $payment->save();

            $reservation->payment_id = $payment->id;
            $reservation->is_paid = 1;
            $reservation->save();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return $payment;
    }
}
