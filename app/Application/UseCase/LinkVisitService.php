<?php

namespace App\Application\UseCase;

use App\Application\Dto\RedirectDto;
use App\Application\LinkVisitRepositoryInterface;

class LinkVisitService
{
    public function __construct(
        public LinkVisitRepositoryInterface $linkVisitServiceRepository
    ) {}

    public function saveVisit(RedirectDto $dto, int $linkId): void
    {
        $this->linkVisitServiceRepository->saveVisit($dto, $linkId);
    }
}
