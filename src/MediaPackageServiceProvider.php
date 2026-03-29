<?php

declare(strict_types=1);

namespace Erp\MediaPackage;

use Erp\MediaPackage\Contracts\MediaAttachmentServiceContract;
use Erp\MediaPackage\Services\MediaAttachmentService;
use Illuminate\Support\ServiceProvider;

class MediaPackageServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(MediaAttachmentServiceContract::class, MediaAttachmentService::class);
    }
}
