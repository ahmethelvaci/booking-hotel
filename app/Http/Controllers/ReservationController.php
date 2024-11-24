<?php

namespace App\Http\Controllers;

use App\Contracts\Services\ReservationService;
use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use App\Http\Resources\ReservationResource;
use App\Models\Reservation;
use Illuminate\Database\Eloquent\Model;

class ReservationController extends Controller
{
    public function __construct(protected ReservationService $service)
    {
        //
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReservationRequest $request)
    {
        $reservation = $this->service->createNewReservation($request->validated());
        
        if ($reservation instanceof Model) {
            return new ReservationResource($reservation);
        }

        return response()->json(['data' => $reservation]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        //
    }
}
