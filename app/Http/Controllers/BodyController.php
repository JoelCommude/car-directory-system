<?php

namespace App\Http\Controllers;

use App\Models\Body;
use App\Http\Resources\BodyResource;
use App\Services\BodyService;
use Illuminate\Http\Request;

class BodyController extends Controller
{
    public function __construct(private BodyService $bodyService,)
    {
        
    }
    public function index()
    {
        return $this->bodyService->getBodyList();
    }
}
