<?php

namespace App\Repositories\House\Filters;

use App\Repositories\FilterContract;
use Illuminate\Database\Eloquent\Builder;

class ByPriceRange implements FilterContract
{
    protected int $minPrice;
    protected int $maxPrice;

    /**
     * ByPrice constructor.
     * @param int $minPrice
     * @param int $maxPrice
     */
    public function __construct (int $minPrice, int $maxPrice)
    {
        $this->minPrice = $minPrice;
        $this->maxPrice = $maxPrice;
    }

    /**
     * @inheritDoc
     */
    public function apply (Builder $query): void
    {
        $query->whereBetween('price', [$this->minPrice, $this->maxPrice]);
    }
}
