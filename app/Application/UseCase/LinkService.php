<?php

namespace App\Application\UseCase;

use App\Application\Dto\LongUrlDto;
use App\Application\Dto\RedirectDto;
use App\Application\Dto\ShortUrlDto;
use App\Application\LinkRepositoryInterface;
use App\Domain\Entities\Exception\LongLinkNotFoundException;

class LinkService
{
    public function __construct(
        public LinkRepositoryInterface $linkRepository,
        public LinkVisitService $linkVisitService
    ) {}

    public function resolveShortLink(LongUrlDto $dto): ShortUrlDto
    {
        $normalizedLink = $this->normalizeLink($dto->url);

        $shortLink = $this->linkRepository->findShortLinkByLong($normalizedLink);
        if ($shortLink != null) {
            return new ShortUrlDto($shortLink);
        }

            $uniqId = $this->linkRepository->saveLongLink($normalizedLink, $dto->userId);
            $base62 = $this->generateBase62Code($uniqId);
            $this->linkRepository->saveShortLink($uniqId, $base62);

            return new ShortUrlDto(config('app.url').'/'.$base62);

    }

    public function getLongLink(RedirectDto $dto): string
    {
        $link = $this->linkRepository->findLongLinkByShort($dto->code);
        if ($link === null) {
            throw new LongLinkNotFoundException('Ссылка не найдена', 404);
        }

        $this->linkVisitService->saveVisit($dto, $link->id);

        return $link->long_link;
    }

    private function generateBase62Code(int $uniqId): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $base = strlen($characters);

        $code = '';

        while ($uniqId > 0) {
            $code = $characters[$uniqId % $base] . $code;
            $uniqId = intdiv($uniqId, $base);
        }

        return $code;
    }

    private function normalizeLink(string $url): string
    {
        $url = trim($url);
        $url = strtolower($url);

        return rtrim($url, '/');
    }
}
