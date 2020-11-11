<?php

namespace Tests\Feature\House;

use App\Models\House;
use Tests\TestCase;

class HouseTest extends TestCase
{
    protected int $perPageCount;

    protected function setUp (): void
    {
        parent::setUp();

        factory(House::class, 100)->create();
        $this->perPageCount = 15;
    }

    public function testCanGetUnfilteredListOfHouses ()
    {
        $this->getJson('houses')
            ->assertSuccessful()
            ->assertJsonCount($this->perPageCount, 'data')
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id', 'name', 'price', 'bedrooms', 'bathrooms', 'storeys', 'garages', 'image',
                    ]
                ]
            ]);
    }

    public function testCanGetFilteredListOfHousesByBedrooms ()
    {
        $bedroomsQty = 1;
        $expected = House::where('bedrooms', $bedroomsQty)->count();
        $expected = $expected > $this->perPageCount ? $this->perPageCount : $expected;

        $response = $this->getJson("houses?bedrooms={$bedroomsQty}");
        $response
            ->assertSuccessful()
            ->assertJsonCount($expected, 'data')
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id', 'name', 'price', 'bedrooms', 'bathrooms', 'storeys', 'garages', 'image',
                    ]
                ]
            ]);

        foreach ($response->json()['data'] as $house) {
            $this->assertEquals($bedroomsQty, $house['bedrooms']);
        };
    }

    public function testCanGetFilteredListOfHousesByBathrooms ()
    {
        $bathroomsQty = 1;
        $expected = House::where('bathrooms', $bathroomsQty)->count();
        $expected = $expected > $this->perPageCount ? $this->perPageCount : $expected;

        $response = $this->getJson("houses?bathrooms={$bathroomsQty}");
        $response
            ->assertSuccessful()
            ->assertJsonCount($expected, 'data')
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id', 'name', 'price', 'bedrooms', 'bathrooms', 'storeys', 'garages', 'image',
                    ]
                ]
            ]);

        foreach ($response->json()['data'] as $house) {
            $this->assertEquals($bathroomsQty, $house['bathrooms']);
        };
    }

    public function testCanGetFilteredListOfHousesByGarages ()
    {
        $garagesQty = 1;
        $expected = House::where('garages', $garagesQty)->count();
        $expected = $expected > $this->perPageCount ? $this->perPageCount : $expected;

        $response = $this->getJson("houses?garages={$garagesQty}");
        $response
            ->assertSuccessful()
            ->assertJsonCount($expected, 'data')
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id', 'name', 'price', 'bedrooms', 'garages', 'storeys', 'garages', 'image',
                    ]
                ]
            ]);

        foreach ($response->json()['data'] as $house) {
            $this->assertEquals($garagesQty, $house['garages']);
        };
    }

    public function testCanGetFilteredListOfHousesByStoreys ()
    {
        $storeysQty = 1;
        $expected = House::where('storeys', $storeysQty)->count();
        $expected = $expected > $this->perPageCount ? $this->perPageCount : $expected;

        $response = $this->getJson("houses?storeys={$storeysQty}");
        $response
            ->assertSuccessful()
            ->assertJsonCount($expected, 'data')
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id', 'name', 'price', 'bedrooms', 'storeys', 'storeys', 'storeys', 'image',
                    ]
                ]
            ]);

        foreach ($response->json()['data'] as $house) {
            $this->assertEquals($storeysQty, $house['storeys']);
        };
    }

    public function testCanGetFilteredListOfHousesByPriceRange ()
    {
        $minPrice = 1000000;
        $maxPrice = 1100000;
        $expected = House::whereBetween('price', [$minPrice, $maxPrice])->count();
        $expected = $expected > $this->perPageCount ? $this->perPageCount : $expected;

        $response = $this->getJson("houses?min_price={$minPrice}&max_price={$maxPrice}");
        $response
            ->assertSuccessful()
            ->assertJsonCount($expected, 'data')
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id', 'name', 'price', 'bedrooms', 'garages', 'storeys', 'garages', 'image',
                    ]
                ]
            ]);

        foreach ($response->json()['data'] as $house) {
            $this->assertGreaterThanOrEqual($minPrice, $house['price']);
            $this->assertLessThanOrEqual($maxPrice, $house['price']);
        };
    }

    public function testCanGetFilteredListOfHousesByName ()
    {
        factory(House::class)->create([
            'name' => $name = 'The Test!'
        ]);

        $expected = House::whereName($name)->count();
        $expected = $expected > $this->perPageCount ? $this->perPageCount : $expected;

        $response = $this->getJson("houses?name={$name}");
        $response
            ->assertSuccessful()
            ->assertJsonCount($expected, 'data')
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id', 'name', 'price', 'bedrooms', 'garages', 'storeys', 'garages', 'image',
                    ]
                ]
            ]);

        foreach ($response->json()['data'] as $house) {
            $this->assertEquals($name, $house['name']);
        };
    }

    public function testCanGetFilteredListOfHousesByNotExactName ()
    {
        factory(House::class)->create([
            'name' => $name = 'The Test!'
        ]);

        $expected = House::whereName($name)->count();
        $expected = $expected > $this->perPageCount ? $this->perPageCount : $expected;

        $name = 'the test';

        $response = $this->getJson("houses?name={$name}");
        $response
            ->assertSuccessful()
            ->assertJsonCount($expected, 'data')
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id', 'name', 'price', 'bedrooms', 'garages', 'storeys', 'garages', 'image',
                    ]
                ]
            ]);
    }

    public function testCanGetFilteredListOfHousesByPartialName ()
    {
        factory(House::class)->create([
            'name' => $name = 'The Test!'
        ]);
        $name = 'est';

        $expected = House::where('name', 'like', "%{$name}%")->count();
        $expected = $expected > $this->perPageCount ? $this->perPageCount : $expected;


        $response = $this->getJson("houses?name={$name}");
        $response
            ->assertSuccessful()
            ->assertJsonCount($expected, 'data')
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id', 'name', 'price', 'bedrooms', 'garages', 'storeys', 'garages', 'image',
                    ]
                ]
            ]);
    }

    public function testCanGetListOrderByField ()
    {
        $response = $this->getJson('houses?sort_by=bedrooms&sort_order=ascending');

        $response
            ->assertSuccessful()
            ->assertJsonCount($this->perPageCount, 'data')
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id', 'name', 'price', 'bedrooms', 'garages', 'storeys', 'garages', 'image',
                    ]
                ]
            ]);

        $data = $response->json()['data'];

        for ($i = 1; $i < count($data); $i++) {
            $this->assertTrue($data[$i - 1]['bedrooms'] <= $data[$i]['bedrooms']);
        }

    }
}
