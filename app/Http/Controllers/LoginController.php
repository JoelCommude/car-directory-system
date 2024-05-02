<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\UserService;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function __construct(private UserService $userService,)
    {
        
    }
    public function store(Request $request)
    {
        return $this->userService->login($request);
    }
}
