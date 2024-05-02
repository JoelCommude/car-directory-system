<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository
{
    public function create(array $data): User
    {
        return User::create($data);
    }

    public function fetchByUsername(string $name): User
    {
        return User::where('username',$name)->first();
    }

    public function update(User $user, array $data): bool
    {
        return $user->update($data);
    }

    public function fetch(int $id) : User
    {
        return User::findOrFail($id);
    }
}