<?php

declare(strict_types=1);

namespace Erp\MediaPackage\Tests\Unit;

use Erp\MediaPackage\Contracts\MediaRepositoryInterface;
use Erp\MediaPackage\Models\Media;
use Erp\MediaPackage\Services\MediaService;
use Illuminate\Database\Eloquent\Model;
use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;

final class MediaServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Mockery::close();
    }

    public function testDeleteReturnsFalseWhenMediaDoesNotExist(): void
    {
        /** @var MediaRepositoryInterface&MockInterface $repository */
        $repository = Mockery::mock(MediaRepositoryInterface::class);
        $repository->shouldReceive('findById')->once()->with('missing-id')->andReturn(null);

        $service = new MediaService($repository);

        self::assertFalse($service->delete('missing-id'));
    }

    public function testAttachToModelUpdatesRelation(): void
    {
        /** @var MediaRepositoryInterface&MockInterface $repository */
        $repository = Mockery::mock(MediaRepositoryInterface::class);

        $model = new class extends Model
        {
            protected $table = 'users';

            public $timestamps = false;

            protected $guarded = [];

            public function getKey(): mixed
            {
                return '42';
            }
        };

        $media = new Media();
        $media->id = 'media-id';
        $media->related_model_type = $model::class;
        $media->related_model_id = '42';

        $repository->shouldReceive('updateRelations')
            ->once()
            ->with('media-id', $model::class, '42')
            ->andReturn($media);

        $service = new MediaService($repository);

        $updated = $service->attachToModel('media-id', $model);

        self::assertSame('42', $updated->related_model_id);
    }
}
