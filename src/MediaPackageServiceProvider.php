<?php

declare(strict_types=1);

namespace Erp\MediaPackage;

use Erp\MediaPackage\Contracts\MediaServiceInterface;
use Erp\MediaPackage\Services\MediaService;
use Illuminate\Support\ServiceProvider;

class MediaPackageServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(MediaServiceInterface::class, MediaService::class);
    }

    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
    }
}
