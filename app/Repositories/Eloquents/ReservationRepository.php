<?php

namespace App\Repositories\Eloquents;

use App\Contracts\Repositories\ReservationRepository as ReservationRepositoryContract;
use App\Models\BookingPerson;
use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use stdClass;

class ReservationRepository implements ReservationRepositoryContract
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
        $reservations = Reservation::paginate();

        return $reservations;
    }

    public function create(array $fields): null|Reservation
    {
        // TODO: This bussiness logic going to move to ReservationService
        $room = Room::find($fields['room_id']);
        $startDate = Carbon::createFromFormat('Y-m-d', $fields['start_date']);
        $endDate = Carbon::createFromFormat('Y-m-d', $fields['end_date']);
        $numberOfNight = intval($startDate->diffInDays($endDate)) - 1;
        $amount = $room->price_per_person * $numberOfNight * $fields['number_of_people'];

        $reservation = new Reservation();

        DB::beginTransaction();
        try {
            $user = auth()->user();
            $user->name = $fields['name'];
            $user->surname = $fields['surname'];
            $user->date_of_birth = $fields['date_of_birth'];
            $user->phone_number = $fields['phone_number'];
            $user->address = $fields['address'];
            $user->tax_no = $fields['tax_no'];
            $user->tax_office = $fields['tax_office'];
            $user->save();
    
            $reservation->hotel_id = $fields['hotel_id'];
            $reservation->room_id = $fields['room_id'];
            $reservation->user_id = $user->id;
            $reservation->payment_id = null;
            $reservation->is_paid = 0;
            $reservation->amount = $amount;
            $reservation->number_of_people = $fields['number_of_people'];
            $reservation->start_date = $fields['start_date'];
            $reservation->end_date = $fields['end_date'];
            $reservation->save();
    
            foreach ($fields['booking_people'] as $person) {
                $bookingPerson = new BookingPerson();
                $bookingPerson->reservation_id = $reservation->id;
                $bookingPerson->name = $person['name'];
                $bookingPerson->surname = $person['surname'];
                $bookingPerson->date_of_birth = $person['date_of_birth'];
                $bookingPerson->phone_number = $person['phone_number'];
                $bookingPerson->save();
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return $reservation;
    }
}
