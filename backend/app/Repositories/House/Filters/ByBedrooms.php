<?php

namespace App\Repositories\House\Filters;

use App\Repositories\FilterContract;
use Illuminate\Database\Eloquent\Builder;

class ByBedrooms implements FilterContract
{
    protected int $qty;

    /**
     * ByGarages constructor.
     * @param int $qty
     */
    public function __construct (int $qty)
    {
        $this->qty = $qty;
    }

    /**
     * @inheritDoc
     */
    public function apply (Builder $query): void
    {
        $query->where('bedrooms', $this->qty);
    }
}
