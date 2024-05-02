<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Http\Resources\CarResource;
use App\Services\CarService;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function __construct(private CarService $carService,)
    {
        
    }
    public function index(Request $request)
    {
        return $this->carService->getCarList((int)$request->id);
    }
}
