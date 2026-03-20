<?php

namespace App\Infrastructure\Persistence\Repositories;

use App\Application\Dto\LoginDto;
use App\Application\UserRepositoryInterface;
use App\Infrastructure\Persistence\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function getOrCreateUser(LoginDto $dto): User
    {
        return User::firstOrCreate([
            'name' => $dto->userName,
        ]);

    }
}
