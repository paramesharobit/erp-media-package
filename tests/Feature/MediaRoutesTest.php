<?php

declare(strict_types=1);

namespace ErpMediaPackage\Tests\Feature;

use ErpMediaPackage\Tests\TestCase;

final class MediaRoutesTest extends TestCase
{
    public function test_it_exposes_media_routes(): void
    {
        $routes = collect($this->app['router']->getRoutes()->getRoutesByMethod());

        $postUris = collect($routes->get('POST', []))->pluck('uri');
        $getUris = collect($routes->get('GET', []))->pluck('uri');
        $deleteUris = collect($routes->get('DELETE', []))->pluck('uri');

        $this->assertTrue($postUris->contains('api/media'));
        $this->assertTrue($getUris->contains('api/media'));
        $this->assertTrue($deleteUris->contains('api/media/{id}'));
    }
}
