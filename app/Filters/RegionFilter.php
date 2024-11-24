<?php

namespace App\Filters;

use App\Contracts\Filters\Filter;
use Illuminate\Http\Request;

class RegionFilter implements Filter
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected Request $request)
    {
        //
    }

    public function getFilters(): array
    {
        $filters = [];

        if ($this->request->has('name')) {
            $filters['name'] = $this->request->get('name');
        }

        if ($this->request->has('city-name')) {
            $filters['city_name'] = $this->request->get('city-name');
        }

        if ($this->request->has('district-name')) {
            $filters['district_name'] = $this->request->get('district-name');
        }

        return $filters;
    }
}
