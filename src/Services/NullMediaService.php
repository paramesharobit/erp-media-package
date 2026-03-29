<?php

declare(strict_types=1);

namespace ErpMediaPackage\Services;

use ErpMediaPackage\Contracts\MediaServiceInterface;
use ErpMediaPackage\DTO\MediaData;
use Illuminate\Support\Collection;
use LogicException;

final class NullMediaService implements MediaServiceInterface
{
    public function create(MediaData $payload): mixed
    {
        throw new LogicException('No media service has been configured.');
    }

    public function list(): Collection
    {
        return collect();
    }

    public function delete(string $id): void
    {
        throw new LogicException('No media service has been configured.');
    }
}
