<?php

namespace App\Http\Controllers;

use App\Contracts\Services\RegionService;
use App\Filters\RegionFilter;
use App\Http\Resources\RegionCollection;
use App\Models\Region;
use Illuminate\Database\Eloquent\Model;

class RegionController extends Controller
{
    public function __construct(protected RegionService $service)
    {
        //
    }

    /**
     * Display a listing of the resource.
     */
    public function index(RegionFilter $filter)
    {
        $regions = $this->service->listRegions($filter);
        
        if ($regions->total() > 0 && $regions->first() instanceof Model) {
            return new RegionCollection($regions);
        }

        return response()->json($regions);
    }
}
