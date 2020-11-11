<?php

/** @var Factory $factory */

use App\Models\House;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Str;

$factory->define(House::class, function (Faker $faker) {

    $imgPaths = [
        'images/01.jpg',
        'images/02.jpg',
        'images/03.jpg',
        'images/04.jpg',
        'images/05.jpg',
        'images/06.jpg',
        'images/07.jpg',
        'images/08.jpg',
        'images/09.jpg',
    ];

    return [
        'name'      => 'The ' . Str::of($faker->name)->ucfirst(),
        'price'     => $faker->numerify('######'),
        'bedrooms'  => $faker->numberBetween(1, 3),
        'bathrooms' => $faker->numberBetween(1, 3),
        'storeys'   => $faker->numberBetween(1, 5),
        'garages'   => $faker->numberBetween(1, 3),
        'image'     => $faker->randomElement($imgPaths),
    ];
});
