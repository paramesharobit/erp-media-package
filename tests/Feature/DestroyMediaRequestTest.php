<?php

declare(strict_types=1);

namespace ErpMediaPackage\Tests\Feature;

use ErpMediaPackage\Http\Requests\DestroyMediaRequest;
use PHPUnit\Framework\TestCase;

final class DestroyMediaRequestTest extends TestCase
{
    public function test_it_requires_uuid_route_parameter(): void
    {
        $request = new DestroyMediaRequest();

        $this->assertSame(['id' => ['required', 'uuid']], $request->rules());
    }
}
