<?php

namespace App\Services;

use App\Repositories\FuelRepository;
use App\Http\Resources\FuelResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class FuelService
{
    public function __construct(
        private FuelRepository $fuelRepository,
    ){}

    public function getFuelList(): AnonymousResourceCollection
    {
        $data = $this->fuelRepository->fetchAll();
        return FuelResource::collection($data);
    }
}