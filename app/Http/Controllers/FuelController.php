<?php

namespace App\Http\Controllers;

use App\Models\Fuel;
use App\Http\Resources\FuelResource;
use App\Services\FuelService;
use Illuminate\Http\Request;

class FuelController extends Controller
{
    public function __construct(private FuelService $fuelService,)
    {
        
    }
    public function index()
    {
        return $this->fuelService->getFuelList();
    }
}
