<?php

namespace App\Application\Dto;

use DateTimeInterface;

final readonly class RedirectDto
{
    public function __construct(
        public string $code,
        public ?string $ip,
        public ?string $userAgent,
        public DateTimeInterface $visitedAt,
    ) {}
}
