<?php

namespace App\Application;

use App\Infrastructure\Persistence\Models\Link;

interface LinkRepositoryInterface {

    public function findShortLinkByLong(string $longLink): ?string;
    public function findLongLinkByShort(string $code): ?Link;

    public function saveShortLink(int $linkId, string $shortLink): void;
    public function saveLongLink(string $longLink, int $userId): int;

}
