<?php

namespace App\Http\Controllers;

use App\Contracts\Services\HotelService;
use App\Filters\HotelFilter;
use App\Http\Requests\StoreHotelRequest;
use App\Http\Requests\UpdateHotelRequest;
use App\Http\Resources\HotelCollection;
use App\Http\Resources\HotelResource;
use App\Models\Hotel;

class HotelController extends Controller
{
    public function __construct(protected HotelService $service)
    {
        //    
    }

    /**
     * Display a listing of the resource.
     */
    public function index(HotelFilter $filter)
    {
        $hotels = $this->service->listHotels($filter);

        return new HotelCollection($hotels);
    }

    /**
     * Display the specified resource.
     */
    public function show(Hotel $hotel)
    {
        //
    }
}