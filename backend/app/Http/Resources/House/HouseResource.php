<?php

namespace App\Http\Resources\House;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class HouseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray ($request)
    {
        return [
            'id'        => $this->id,
            'name'      => $this->name,
            'price'     => $this->price,
            'bedrooms'  => $this->bedrooms,
            'bathrooms' => $this->bathrooms,
            'storeys'   => $this->storeys,
            'garages'   => $this->garages,
            'image'     => $this->when($this->image, Storage::url($this->image)),
        ];
    }
}
