<?php

namespace App\Infrastructure\Auth;

use App\Application\AuthenticatorInterface;
use App\Infrastructure\Persistence\Models\User;
use Illuminate\Support\Facades\Auth;

class Authenticator implements AuthenticatorInterface
{
    public function login(User $user): void
    {
        Auth::login($user);
    }
}
