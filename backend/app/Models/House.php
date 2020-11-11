<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'price', 'bedrooms', 'bathrooms', 'storeys', 'garages'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'name'      => 'string',
        'price'     => 'int',
        'bedrooms'  => 'int',
        'bathrooms' => 'int',
        'storeys'   => 'int',
        'garages'   => 'int',
    ];
}
