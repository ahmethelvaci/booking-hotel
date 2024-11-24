<?php

namespace App\Http\Controllers;

use App\Contracts\Services\HotelService;
use App\Filters\HotelFilter;
use App\Http\Requests\StoreHotelRequest;
use App\Http\Requests\UpdateHotelRequest;
use App\Http\Resources\HotelCollection;
use App\Http\Resources\HotelResource;
use App\Models\Hotel;
use Illuminate\Database\Eloquent\Model;

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
        
        if ($hotels->total() > 0 && $hotels->first() instanceof Model) {
            return new HotelCollection($hotels);
        }

        return response()->json($hotels);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $hotel = $this->service->findHotel($id);
        
        if ($hotel instanceof Model) {
            return new HotelResource($hotel);
        }

        return response()->json(['data' => $hotel]);
    }
}
