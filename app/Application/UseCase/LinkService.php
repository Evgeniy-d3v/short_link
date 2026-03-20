<?php

namespace App\Application\UseCase;

use App\Application\Dto\LongUrlDto;
use App\Application\Dto\RedirectDto;
use App\Application\Dto\ShortUrlDto;
use App\Application\LinkRepositoryInterface;
use App\Domain\Entities\Enum\ShortCodeLength;
use App\Domain\Entities\Exception\DuplicateShortLinkException;
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
        do {
            $code = $this->generateCode();
            try {
                $this->linkRepository->saveLinks($code, $normalizedLink, $dto->userId);

                return new ShortUrlDto(config('app.url').'/'.$code);
            } catch (DuplicateShortLinkException) {
            }
        } while (true);
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

    private function generateCode(): string
    {

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $code = '';

        for ($i = 0; $i < ShortCodeLength::SHORT->value; $i++) {
            $code .= $characters[random_int(0, $charactersLength - 1)];
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
