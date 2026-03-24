<?php

namespace App\Infrastructure\Persistence\Repositories;

use App\Application\LinkRepositoryInterface;
use App\Infrastructure\Persistence\Models\Link;
use Illuminate\Database\QueryException;

class LinkRepository implements LinkRepositoryInterface
{
    public function saveShortLink(int $linkId, string $shortLink): void
    {
        $link = Link::findOrFail($linkId);

        $link->short_link = $shortLink;
        $link->save();
    }

    public function findShortLinkByLong(string $longLink): ?string
    {
        $link = Link::where('long_link', $longLink)->first();

        return $link?->short_link;
    }

    public function findLongLinkByShort(string $code): ?Link
    {
        return Link::where('short_link', $code)->first();

    }
    public function saveLongLink(string $longLink, int $userId): int
    {
        return  Link::query()->create([
            'long_link' => $longLink,
            'user_id' => $userId,
        ])->id;
    }

    private function isDuplicateException(QueryException $e): bool
    {
        $sqlState = $e->errorInfo[0] ?? null;
        $driverCode = $e->errorInfo[1] ?? null;

        return $sqlState === '23000' && $driverCode === 1062;
    }
}
