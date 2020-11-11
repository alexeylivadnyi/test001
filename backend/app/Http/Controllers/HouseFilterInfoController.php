<?php

namespace App\Http\Controllers;

use App\Http\Resources\House\HouseFilterInfoResource;
use App\Repositories\HouseFilterInfo\HouseFilterInfoRepository;
use Illuminate\Http\Resources\Json\JsonResource;

class HouseFilterInfoController extends Controller
{
    protected HouseFilterInfoRepository $repository;

    /**
     * HouseFilterInfoController constructor.
     * @param HouseFilterInfoRepository $repository
     */
    public function __construct (HouseFilterInfoRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResource
     */
    public function index(): JsonResource
    {
        return HouseFilterInfoResource::make($this->repository->get());
    }
}
