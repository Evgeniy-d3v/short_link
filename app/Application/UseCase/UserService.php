<?php

namespace App\Application\UseCase;

use App\Application\AuthenticatorInterface;
use App\Application\Dto\LoginDto;
use App\Application\UserRepositoryInterface;

class UserService
{
    public function __construct(
        public UserRepositoryInterface $userRepository,
        public AuthenticatorInterface $authenticator
    ) {}

    public function loginUser(LoginDto $dto): void
    {
        $user = $this->userRepository->getOrCreateUser($dto);
        $this->authenticator->login($user);
    }
}
