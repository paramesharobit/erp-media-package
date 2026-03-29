<?php

declare(strict_types=1);

namespace Arobit\ErpMedia\Tests\Unit;

use Arobit\ErpMedia\Contracts\MediaRepositoryContract;
use Arobit\ErpMedia\Contracts\MediaServiceContract;
use Arobit\ErpMedia\Repositories\MediaRepository;
use Arobit\ErpMedia\Services\MediaService;
use Arobit\ErpMedia\Tests\TestCase;

final class MediaServiceBindingTest extends TestCase
{
    public function test_service_bindings_are_registered(): void
    {
        $this->assertInstanceOf(MediaRepository::class, $this->app->make(MediaRepositoryContract::class));
        $this->assertInstanceOf(MediaService::class, $this->app->make(MediaServiceContract::class));
    }
}
