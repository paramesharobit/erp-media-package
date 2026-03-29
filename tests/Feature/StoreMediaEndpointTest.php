<?php

declare(strict_types=1);

namespace Arobit\ErpMedia\Tests\Feature;

use Arobit\ErpMedia\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

final class StoreMediaEndpointTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_media_endpoint_persists_media_and_returns_json_api_shape(): void
    {
        Storage::fake('public');

        $response = $this->postJson('/api/erp-media/media', [
            'file' => UploadedFile::fake()->image('avatar.png'),
            'disk' => 'public',
            'directory' => 'uploads',
            'visibility' => 'private',
        ]);

        $response->assertCreated()
            ->assertJsonStructure([
                'data' => [
                    'type',
                    'id',
                    'attributes' => [
                        'disk',
                        'directory',
                        'name',
                        'mime_type',
                        'extension',
                        'size',
                        'path',
                        'metadata',
                        'created_at',
                        'updated_at',
                    ],
                ],
            ]);

        $this->assertDatabaseCount('erp_media', 1);
    }
}
