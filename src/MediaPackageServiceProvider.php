<?php

declare(strict_types=1);

namespace Erp\MediaPackage;

use Erp\MediaPackage\Contracts\MediaRepositoryInterface;
use Erp\MediaPackage\Contracts\MediaServiceInterface;
use Erp\MediaPackage\Repositories\MediaRepository;
use Erp\MediaPackage\Services\MediaService;
use Illuminate\Support\ServiceProvider;

class MediaPackageServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/media.php', 'media');

        $this->app->bind(MediaRepositoryInterface::class, MediaRepository::class);
        $this->app->bind(MediaServiceInterface::class, MediaService::class);
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/media.php' => config_path('media.php'),
        ], 'media-package-config');

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }
}
