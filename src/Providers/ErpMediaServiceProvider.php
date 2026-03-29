<?php

declare(strict_types=1);

namespace ErpMediaPackage\Providers;

use ErpMediaPackage\Contracts\MediaServiceInterface;
use Illuminate\Support\ServiceProvider;

final class ErpMediaServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/erp-media.php', 'erp-media');

        $this->app->bind(MediaServiceInterface::class, (string) config('erp-media.service'));
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../../config/erp-media.php' => config_path('erp-media.php'),
        ], 'erp-media-config');

        $this->loadRoutesFrom(__DIR__.'/../../routes/api.php');
    }
}
