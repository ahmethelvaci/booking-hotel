<?php

namespace App\Repositories\Databases;

use App\Contracts\Repositories\ReservationRepository as ReservationRepositoryContract;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use stdClass;

class ReservationRepository implements  ReservationRepositoryContract
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
        $reservations = DB::table('reservations')->paginate();

        return $reservations;
    }

    public function create(array $fields): null|stdClass
    {
        // TODO: This bussiness logic going to move to ReservationService
        $room = DB::table('rooms')
            ->where('id', $fields['room_id'])
            ->first();
        $startDate = Carbon::createFromFormat('Y-m-d', $fields['start_date']);
        $endDate = Carbon::createFromFormat('Y-m-d', $fields['end_date']);
        $numberOfNight = intval($startDate->diffInDays($endDate)) - 1;
        $amount = $room->price_per_person * $numberOfNight * $fields['number_of_people'];

        $reservation = new stdClass;

        DB::beginTransaction();
        try {
            $userId = auth()->user()->id;


            DB::table('users')
                ->where('id', $userId)
                ->update([
                    'name' => $fields['name'],
                    'surname' => $fields['surname'],
                    'date_of_birth' => $fields['date_of_birth'],
                    'phone_number' => $fields['phone_number'],
                    'address' => $fields['address'],
                    'tax_no' => $fields['tax_no'],
                    'tax_office' => $fields['tax_office'],
                    'updated_at' => now()
                ]);
    
            $reservationId = DB::table('reservations')
                ->insertGetId([
                    'hotel_id' => $fields['hotel_id'],
                    'room_id' => $fields['room_id'],
                    'user_id' => $userId,
                    'payment_id' => null,
                    'is_paid' => 0,
                    'amount' => $amount,
                    'number_of_people' => $fields['number_of_people'],
                    'start_date' => $fields['start_date'],
                    'end_date' => $fields['end_date'],
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
    
            foreach ($fields['booking_people'] as $person) {
                DB::table('booking_people')
                    ->insert([
                        'reservation_id' => $reservationId,
                        'name' => $person['name'],
                        'surname' => $person['surname'],
                        'date_of_birth' => $person['date_of_birth'],
                        'phone_number' => $person['phone_number'],
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);

                $reservation = DB::table('reservations')
                    ->where('id', $reservationId)
                    ->first();
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return $reservation;
    }
}
