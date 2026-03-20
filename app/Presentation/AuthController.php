<?php

namespace App\Presentation;

use App\Application\Dto\LoginDto;
use App\Application\UseCase\UserService;
use App\Presentation\Request\AuthRequest\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AuthController
{
    public function __construct(
        public UserService $service
    ) {}

    public function index(): View
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request): RedirectResponse
    {

        $loginDto = new LoginDto(
            $request->validated()['name']
        );

        $this->service->loginUser($loginDto);

        $request->session()->regenerate();

        return redirect('/');
    }
}
