<?php

declare(strict_types=1);

namespace Erp\MediaPackage\Tests;

use Erp\MediaPackage\DTO\MediaUploadData;
use Erp\MediaPackage\Models\Media;
use Erp\MediaPackage\Services\MediaService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class MediaServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_upload_stores_file_and_metadata(): void
    {
        Storage::fake('public');

        $service = app(MediaService::class);
        $file = UploadedFile::fake()->image('avatar.png');

        $media = $service->upload(new MediaUploadData(file: $file));

        $this->assertDatabaseHas('media', ['id' => $media->id]);
        Storage::disk('public')->assertExists($media->path);
        $this->assertMatchesRegularExpression('/^[a-f0-9\-]{36}\.png$/', $media->filename);
    }

    public function test_safe_delete_removes_record_and_file(): void
    {
        Storage::fake('public');

        $service = app(MediaService::class);
        $file = UploadedFile::fake()->create('doc.pdf', 10, 'application/pdf');

        $media = $service->upload(new MediaUploadData(file: $file));

        $this->assertTrue($service->safeDelete($media->id));
        $this->assertDatabaseMissing('media', ['id' => $media->id]);
        Storage::disk('public')->assertMissing($media->path);
    }

    public function test_safe_delete_handles_missing_file_without_orphan_record(): void
    {
        Storage::fake('public');

        $service = app(MediaService::class);
        $file = UploadedFile::fake()->create('doc.pdf', 10, 'application/pdf');

        $media = $service->upload(new MediaUploadData(file: $file));
        Storage::disk('public')->delete($media->path);

        $this->assertTrue($service->safeDelete($media->id));
        $this->assertNull(Media::query()->find($media->id));
    }
}
