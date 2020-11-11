<?php

namespace App\Repositories\HouseFilterInfo;

use Illuminate\Support\Facades\DB;

class EloquentHouseFilterInfoRepository implements HouseFilterInfoRepository
{

    /**
     * @inheritDoc
     */
    public function get ()
    {
        return DB::table('houses')
            ->select(
                DB::raw('max(bedrooms) as bedrooms'),
                DB::raw('max(bathrooms) as bathrooms'),
                DB::raw('max(storeys) as storeys'),
                DB::raw('max(garages) as garages'),
                DB::raw('max(price) as max_price')
            )
            ->first();
    }
}
