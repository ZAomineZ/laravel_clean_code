<?php

declare(strict_types=1);

namespace App\Providers;

use Domain\Blogging\Projectors\PostProjector;
use Domain\Blogging\Reactors\PostReactor;
use Illuminate\Support\ServiceProvider;
use Spatie\EventSourcing\Facades\Projectionist;

final class EventSourcingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        Projectionist::addProjectors([
            PostProjector::class
        ]);

        Projectionist::addReactors([
           PostReactor::class
        ]);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
    }
}
