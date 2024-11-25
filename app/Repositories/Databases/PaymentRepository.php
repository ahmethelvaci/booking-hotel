<?php

namespace App\Repositories\Databases;

use App\Contracts\Repositories\PaymentRepository as PaymentRepositoryContract;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use stdClass;

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
        
    }

    public function create(array $fields): null|stdClass
    {
        $payment = new stdClass();

        DB::beginTransaction();
        try {
            $reservation = DB::table('reservations')
                ->where('id', $fields['reservation_id'])
                ->first();
            
            $paymentId = DB::table('payments')->insertGetId([
                'reservation_id' => $fields['reservation_id'],
                'amount' => $reservation->amount,
                'is_success' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            DB::table('reservations')
                ->where('id', $fields['reservation_id'])
                ->update([
                    'payment_id' => $paymentId,
                    'is_paid' => 1,
                    'updated_at' => now()
                ]);

            $payment = DB::table('payments')->where('id', $paymentId)->first();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return $payment;
    }
}
