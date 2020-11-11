<?php

namespace Tests\Feature\House;

use App\Models\House;
use Tests\TestCase;

class HouseFilterInfoTest extends TestCase
{
    public function testCanGetFilterInfoForHouses ()
    {
        factory(House::class, 100)->create();

        $this->getJson('info')
            ->assertSuccessful()
            ->assertJsonStructure([
                'data' => [
                    'bedrooms', 'bathrooms', 'storeys', 'garages', 'max_price',
                ]
            ]);
    }
}
