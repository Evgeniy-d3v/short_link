<?php

namespace App\Application\Dto;

final readonly class ShortUrlDto
{
    public function __construct(
        public string $url,
    ) {}
}
