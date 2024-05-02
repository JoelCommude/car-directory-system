<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;



class RegisterController extends Controller
{

    public function __construct(private UserService $userService,)
    {
        
    }
    public function show($id)
    {
        return $this->userService->getUsername($id);
    }

    public function edit($id, Request $request)
    {
        return $this->userService->updatePassword($id,$request->all());
    }

    public function update(Request $request, $id)
    {
        return $this->userService->updateUser($request->all());
    }
}
