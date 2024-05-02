<?php

namespace App\Repositories;

use App\Models\Fuel;
use Illuminate\Database\Eloquent\Collection;

class FuelRepository
{
    public function fetchAll(): Collection
    {
        return Fuel::all();
    }
}