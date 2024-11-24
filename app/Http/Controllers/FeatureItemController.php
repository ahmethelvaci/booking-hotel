<?php

namespace App\Http\Controllers;

use App\Contracts\Services\HotelService;
use App\Http\Resources\FeatureItemCollection;

class FeatureItemController extends Controller
{
    public function __construct(protected HotelService $service)
    {
        //    
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $feautreItems = $this->service->listFeatureItems();
        
        if ($feautreItems->total() > 0 && $feautreItems->first() instanceof Model) {
            return new FeatureItemCollection($feautreItems);
        }

        return response()->json($feautreItems);
    }
}
