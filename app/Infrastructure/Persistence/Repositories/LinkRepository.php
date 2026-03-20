<?php

namespace App\Infrastructure\Persistence\Repositories;

use App\Application\LinkRepositoryInterface;
use App\Domain\Entities\Exception\DuplicateShortLinkException;
use App\Infrastructure\Persistence\Models\Link;
use Illuminate\Database\QueryException;

class LinkRepository implements LinkRepositoryInterface
{
    public function saveLinks(string $shortLink, string $longLink, int $userId): void
    {
        try {
            Link::query()->create([
                'short_link' => $shortLink,
                'long_link' => $longLink,
                'user_id' => $userId,
            ]);
        } catch (QueryException $e) {
            if ($this->isDuplicateException($e)) {
                throw new DuplicateShortLinkException('Короткая ссылка уже существует.', previous: $e);
            }
        }
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

    private function isDuplicateException(QueryException $e): bool
    {
        $sqlState = $e->errorInfo[0] ?? null;
        $driverCode = $e->errorInfo[1] ?? null;

        return $sqlState === '23000' && $driverCode === 1062;
    }
}
