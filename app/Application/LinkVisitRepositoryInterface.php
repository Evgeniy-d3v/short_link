<?php

namespace App\Application;

use App\Application\Dto\RedirectDto;

interface LinkVisitRepositoryInterface
{
    public function saveVisit(RedirectDto $dto, int $linkId): void;
}
