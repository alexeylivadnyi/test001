<?php

namespace App\Providers;

use App\Repositories\House\EloquentHouseRepository;
use App\Repositories\House\HouseRepository;
use App\Repositories\HouseFilterInfo\EloquentHouseFilterInfoRepository;
use App\Repositories\HouseFilterInfo\HouseFilterInfoRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    protected array $reps = [
        HouseRepository::class           => EloquentHouseRepository::class,
        HouseFilterInfoRepository::class => EloquentHouseFilterInfoRepository::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register ()
    {
        foreach ($this->reps as $definition => $rep) {
            $this->app->bind($definition, $rep);
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot ()
    {
        //
    }
}
