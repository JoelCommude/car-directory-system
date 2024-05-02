<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Models\User;
use App\Repositories\TransactionRepository;
use App\Http\Resources\UserResource;
use App\Http\Resources\TransactionResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PhpOption\None;
use SebastianBergmann\Type\NullType;

class UserService
{
    public function __construct(
        private UserRepository $userRepository,
        private TransactionRepository $transactionRepository,
    ){}

    public function login(object $data)
    {
        if(Auth::attempt(['username' => $data->username, 'password' => $data->password])){
            $datas[] = $this->userRepository->fetchByUsername($data->username);
            return UserResource::collection($datas);
        }
    }

    public function addUser(array $data): string
    {
        $data['password'] = Hash::make($data['password']);
        $this->userRepository->create($data);
        if(isset($data['company_id'])){
            $this->transactionRepository->create($data);
        }
        return 'Success';
    }

    public function getUsername(string $name): User
    {
        return $this->userRepository->fetchByUsername($name);
    }

    public function updatePassword(string $name,array $data): string
    {
        $data['password'] = Hash::make($data['password']);
        $user = $this->userRepository->fetchByUsername($name);
        $this->userRepository->update($user,$data);
        return 'Success';
    }

    public function updateUser(array $data): string
    {
        $user = $this->userRepository->fetch($data['id']);
        $this->userRepository->update($user,$data);
        return 'Success';
    }

    public function getTransaction(object $data)
    {
        $datas = $this->transactionRepository->fetch($data);
        return TransactionResource::collection($datas);
    }

    public function getTransactionByUser(int $id)
    {
        $data = $this->transactionRepository->fetchByUserId($id);
        return TransactionResource::collection($data);
    }
}