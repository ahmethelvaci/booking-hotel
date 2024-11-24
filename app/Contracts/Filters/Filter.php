<?php
namespace App\Contracts\Filters;

interface Filter
{
    /**
     * @return array
     */
    public function getFilters(): array;
}