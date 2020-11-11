<?php

namespace App\Repositories\House\Filters;

use App\Repositories\FilterContract;
use Illuminate\Database\Eloquent\Builder;

class ByName implements FilterContract
{
    protected string $name;

    /**
     * ByName constructor.
     * @param string $name
     */
    public function __construct (string $name)
    {
        $this->name = $name;
    }

    /**
     * @inheritDoc
     */
    public function apply (Builder $query): void
    {
        $query->where('name', 'like', "%{$this->name}%");
    }
}
