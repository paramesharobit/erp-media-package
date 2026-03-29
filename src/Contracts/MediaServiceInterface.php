<?php

declare(strict_types=1);

namespace Erp\MediaPackage\Contracts;

use Erp\MediaPackage\DTO\MediaDTO;
use Erp\MediaPackage\Models\Media;
use Illuminate\Database\Eloquent\Model;

interface MediaServiceInterface
{
    public function upload(MediaDTO $dto): Media;

    public function delete(string $id): bool;

    public function attachToModel(string $mediaId, Model $model): Media;
}
