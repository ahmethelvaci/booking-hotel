<?php

namespace App\Filters;

use App\Contracts\Filters\Filter;
use Illuminate\Http\Request;

class HotelFilter implements Filter
{
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

        if ($this->request->has('type')) {
            $filters['type'] = $this->request->get('type');
        }

        if ($this->request->has('region')) {
            $filters['region'] = $this->request->get('region');
        }

        if ($this->request->has('min-price')) {
            $filters['min-price'] = $this->request->get('min-price');
        }

        if ($this->request->has('max-price')) {
            $filters['max-price'] = $this->request->get('max-price');
        }

        if ($this->request->has('feature_items')) {
            $filters['feature_items'] = $this->request->get('feature_items');
        }

        if ($this->request->has('sort_type')) {
            $filters['sort_type'] = $this->request->get('sort_type');
        }

        if ($this->request->has('sort_direction')) {
            $filters['sort_direction'] = $this->request->get('sort_direction');
        }

        return $filters;
    }
}
