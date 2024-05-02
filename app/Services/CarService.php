<?php

namespace App\Services;

use App\Repositories\CarRepository;
use App\Http\Resources\CarResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CarService
{
    public function __construct(
        private CarRepository $carRepository,
    ){}

    public function getCarList(int $id): AnonymousResourceCollection
    {
        $data = $this->carRepository->fetchByCompany($id);
        return CarResource::collection($data);
    }
}