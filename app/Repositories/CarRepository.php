<?php

namespace App\Repositories;

use App\Models\Car;


class CarRepository
{
    public function fetchByCompany(int $id): mixed
    {
        return Car::where('company_id',$id)->get();
    }
}