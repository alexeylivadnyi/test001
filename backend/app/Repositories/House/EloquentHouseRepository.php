<?php

namespace App\Repositories\House;

use App\Models\House;
use App\Repositories\WithFilters;

class EloquentHouseRepository implements HouseRepository
{
    use WithFilters;

    /**
     * @inheritDoc
     */
    public function paginate (int $perPage = 15, array $columns = ['*'])
    {
        $query = House::query();

        $this->applyFilter($query);

        return $query->paginate($perPage, $columns);
    }
}
