<?php

namespace App\Application\Dto;

final readonly class LongUrlDto
{
    public function __construct(
        public int $userId,
        public string $url,
    ) {}
}
