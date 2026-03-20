<?php

namespace App\Application\Dto;

final readonly class LoginDto
{
    public function __construct(
        public string $userName
    ) {}
}
