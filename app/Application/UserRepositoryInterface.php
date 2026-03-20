<?php

namespace App\Application;

use App\Application\Dto\LoginDto;
use App\Infrastructure\Persistence\Models\User;

interface UserRepositoryInterface
{
    public function getOrCreateUser(LoginDto $dto): User;
}
