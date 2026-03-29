<?php

declare(strict_types=1);

namespace Erp\MediaPackage\Repositories;

use Erp\MediaPackage\Contracts\MediaRepositoryInterface;
use Erp\MediaPackage\Models\Media;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class MediaRepository implements MediaRepositoryInterface
{
    public function create(array $attributes): Media
    {
        return Media::query()->create($attributes);
    }

    public function findById(string $id): ?Media
    {
        return Media::query()->find($id);
    }

    public function delete(string $id): bool
    {
        return (bool) Media::query()->whereKey($id)->delete();
    }

    public function updateRelations(string $id, ?string $relatedModelType, ?string $relatedModelId): Media
    {
        $media = $this->findById($id);

        if ($media === null) {
            throw new ModelNotFoundException('Media not found.');
        }

        $media->related_model_type = $relatedModelType;
        $media->related_model_id = $relatedModelId;
        $media->save();

        return $media->refresh();
    }
}
