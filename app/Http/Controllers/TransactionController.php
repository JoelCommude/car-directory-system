<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Http\Resources\TransactionResource;
use App\Services\UserService;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function __construct(private UserService $userService,)
    {
        
    }
    public function index(Request $request)
    {
        return $this->userService->getTransaction($request);
    }
    public function show($id)
    {
        return $this->userService->getTransactionByUser($id);
    }
}
