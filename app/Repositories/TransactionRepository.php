<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class TransactionRepository
{
    public function create(array $data){
        $data['user_id'] = User::max('id');
        return Transaction::create($data);
    }

    public function fetch(object $data)
    {
        return Transaction::join('companies', 'transactions.company_id', 'companies.id')
        ->join('cars', 'transactions.car_id', 'cars.id')
        ->join('users', 'transactions.user_id', 'users.id')
        ->when($data->filled('roleID') && $data->roleID == 2, fn($q) => $q->where('transactions.user_id', $data->userID))
        ->when($data->filled('company'), fn($q) => $q->where('transactions.company_id', $data->company))
        ->when($data->filled('search'), fn($q) => $q->where(fn($sq) => $sq->where('plate_number', 'LIKE', '%' . $data->search . '%')
            ->orWhere('engine_number', 'LIKE', '%' . $data->search . '%')
            ->orWhere('companies.name', 'LIKE', '%' . $data->search . '%')
            ->orWhere('cars.name', 'LIKE', '%' . $data->search . '%')
            ->orWhere('users.first_name', 'LIKE', '%' . $data->search . '%')
            ->orWhere('users.last_name', 'LIKE', '%' . $data->search . '%')))
        ->whereNull('users.deleted_at')
        ->get();
    }

    public function fetchByUserId(int $id)
    {
        return Transaction::where('user_id',$id)->first();
    }
}