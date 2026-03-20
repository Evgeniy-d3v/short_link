<?php

namespace App\Application;

use App\Infrastructure\Persistence\Models\User;

interface AuthenticatorInterface
{
    public function login(User $user): void;
}
