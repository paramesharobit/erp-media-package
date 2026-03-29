<?php

declare(strict_types=1);

namespace Arobit\ErpMedia;

use Arobit\ErpMedia\Contracts\MediaRepositoryContract;
use Arobit\ErpMedia\Contracts\MediaServiceContract;
use Arobit\ErpMedia\Repositories\MediaRepository;
use Arobit\ErpMedia\Services\MediaService;
use Illuminate\Support\ServiceProvider;

final class ErpMediaServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/media.php', 'erp-media');

        $this->app->bind(MediaRepositoryContract::class, MediaRepository::class);
        $this->app->bind(MediaServiceContract::class, MediaService::class);
    }

    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->publishes([
            __DIR__.'/../config/media.php' => config_path('erp-media.php'),
        ], 'erp-media-config');
    }
}
