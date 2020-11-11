<?php

namespace App\Http\Resources\House;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HouseFilterInfoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray ($request)
    {
        return [
            'bedrooms'  => $this->bedrooms,
            'bathrooms' => $this->bathrooms,
            'storeys'   => $this->storeys,
            'garages'   => $this->garages,
            'max_price' => $this->max_price,
        ];
    }
}
