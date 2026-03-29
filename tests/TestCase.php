<?php

declare(strict_types=1);

namespace ErpMediaPackage\Tests;

use ErpMediaPackage\Providers\ErpMediaServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    /**
     * @return array<int, class-string>
     */
    protected function getPackageProviders($app): array
    {
        return [ErpMediaServiceProvider::class];
    }
}
