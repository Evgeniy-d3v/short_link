<?php

namespace App\Infrastructure\Persistence\Repositories;

use App\Application\Dto\RedirectDto;
use App\Application\LinkVisitRepositoryInterface;
use App\Infrastructure\Persistence\Models\LinkVisit;

class LinkVisitRepository implements LinkVisitRepositoryInterface
{
    public function saveVisit(RedirectDto $dto, int $linkId): void
    {

        LinkVisit::query()->create([
            'ip' => $dto->ip,
            'user_agent' => $dto->userAgent,
            'visited_at' => $dto->visitedAt,
            'link_id' => $linkId,
        ]);
    }
}
