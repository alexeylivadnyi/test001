<?php

namespace App\Http\Requests\House;

use Illuminate\Foundation\Http\FormRequest;

class HouseIndexRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize ()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules ()
    {
        return [
            'bedrooms'   => 'int',
            'bathrooms'  => 'int',
            'storeys'    => 'int',
            'garages'    => 'int',
            'min_price'  => 'int|required_with:max_price',
            'max_price'  => 'int|required_with:min_price',
            'sort_by'    => 'required_with:sort_order',
            'sort_order' => 'required_with:sort_by',
        ];
    }
}
