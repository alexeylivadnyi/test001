<?php

namespace App\Repositories\House;

interface HouseRepository
{
    /**
     * @param int   $perPage
     * @param array $columns
     * @return mixed
     */
    public function paginate (int $perPage = 15, array $columns = ['*']);
}
