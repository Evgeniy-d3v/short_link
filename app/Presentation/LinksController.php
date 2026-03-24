<?php

namespace App\Presentation;

use App\Application\Dto\LongUrlDto;
use App\Application\Dto\RedirectDto;
use App\Application\UseCase\LinkService;
use App\Presentation\Request\LinkRequest\RedirectRequest;
use App\Presentation\Request\LinkRequest\StorageRequest;
use Illuminate\View\View;

class LinksController
{
    public function __construct(
        public LinkService $service
    ) {}

    public function index(): View
    {
        return view('links.links');
    }

    public function store(StorageRequest $request): View
    {

        $dto = new LongUrlDto(
            auth()->id(),
            $request->validated()['url']
        );
        $link = $this->service->resolveShortLink($dto)->url;

        return view('links.links', [
            'shortLink' => $link,
        ]);
    }

    public function redirect(RedirectRequest $request)
    {
        $redirectDto = new RedirectDto(
            $request->validated()['code'],
            $request->ip(),
            $request->userAgent(),
            now(),
        );

        return redirect()->away($this->service->getLongLink($redirectDto));
    }
}
