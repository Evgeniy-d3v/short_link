<?php

namespace App\Infrastructure\Providers;

use App\Application\AuthenticatorInterface;
use App\Application\LinkRepositoryInterface;
use App\Application\LinkVisitRepositoryInterface;
use App\Application\UserRepositoryInterface;
use App\Infrastructure\Auth\Authenticator;
use App\Infrastructure\Persistence\Repositories\LinkRepository;
use App\Infrastructure\Persistence\Repositories\LinkVisitRepository;
use App\Infrastructure\Persistence\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(LinkRepositoryInterface::class, function ($app) {
            return new LinkRepository;
        });
        $this->app->bind(UserRepositoryInterface::class, function ($app) {
            return new UserRepository;
        });
        $this->app->bind(LinkVisitRepositoryInterface::class, function ($app) {
            return new LinkVisitRepository;
        });
        $this->app->bind(AuthenticatorInterface::class, function ($app) {
            return new Authenticator;
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
