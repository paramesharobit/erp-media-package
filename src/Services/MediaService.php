<?php

declare(strict_types=1);

namespace Arobit\ErpMedia\Services;

use Arobit\ErpMedia\Contracts\MediaRepositoryContract;
use Arobit\ErpMedia\Contracts\MediaServiceContract;
use Arobit\ErpMedia\DTOs\StoreMediaData;
use Arobit\ErpMedia\Models\Media;

final readonly class MediaService implements MediaServiceContract
{
    public function __construct(private MediaRepositoryContract $repository)
    {
    }

    public function store(StoreMediaData $data): Media
    {
        return $this->repository->create($data);
    }
}
