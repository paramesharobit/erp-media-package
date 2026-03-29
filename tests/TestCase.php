<?php

declare(strict_types=1);

namespace Arobit\ErpMedia\Tests;

use Arobit\ErpMedia\ErpMediaServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [ErpMediaServiceProvider::class];
    }
}
