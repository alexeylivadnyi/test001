<?php

namespace App\Http\Controllers;

use App\Http\Requests\House\HouseIndexRequest;
use App\Http\Resources\House\HouseResource;
use App\Repositories\House\Filters\ByBathrooms;
use App\Repositories\House\Filters\ByBedrooms;
use App\Repositories\House\Filters\ByGarages;
use App\Repositories\House\Filters\ByName;
use App\Repositories\House\Filters\ByPriceRange;
use App\Repositories\House\Filters\ByStoreys;
use App\Repositories\House\Filters\SortBy;
use App\Repositories\House\HouseRepository;
use Illuminate\Http\Resources\Json\JsonResource;

class HouseController extends Controller
{
    protected HouseRepository $repository;

    /**
     * HouseController constructor.
     * @param HouseRepository $repository
     */
    public function __construct (HouseRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param HouseIndexRequest $request
     * @return JsonResource
     */
    public function index (HouseIndexRequest $request): JsonResource
    {
        if ($request->has('name')) {
            $this->repository->pushFilter(new ByName($request->get('name')));
        }
        if ($request->has('garages')) {
            $this->repository->pushFilter(new ByGarages($request->get('garages')));
        }
        if ($request->has('bedrooms')) {
            $this->repository->pushFilter(new ByBedrooms($request->get('bedrooms')));
        }
        if ($request->has('bathrooms')) {
            $this->repository->pushFilter(new ByBathrooms($request->get('bathrooms')));
        }
        if ($request->has('storeys')) {
            $this->repository->pushFilter(new ByStoreys($request->get('storeys')));
        }
        if ($request->has('min_price')) {
            $this->repository->pushFilter(new ByPriceRange(
                $request->get('min_price'), $request->get('max_price')
            ));
        }
        if ($request->has('sort_by')) {
            $this->repository->pushFilter(new SortBy(
                $request->get('sort_by'),
                $request->get('sort_order')
            ));
        }
        return HouseResource::collection(
            $this->repository->paginate()
        );
    }
}
