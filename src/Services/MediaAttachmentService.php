<?php

declare(strict_types=1);

namespace Erp\MediaPackage\Services;

use Erp\MediaPackage\Contracts\MediaAttachmentServiceContract;
use Erp\MediaPackage\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class MediaAttachmentService implements MediaAttachmentServiceContract
{
    public function attach(Model $model, string $mediaId): Media
    {
        /** @var Media|null $media */
        $media = Media::query()->find($mediaId);

        if ($media === null) {
            throw (new ModelNotFoundException())->setModel(Media::class, [$mediaId]);
        }

        $media->forceFill([
            'related_model_type' => $model->getMorphClass(),
            'related_model_id' => (string) $model->getKey(),
        ])->save();

        return $media->refresh();
    }

    public function detach(Model $model, string $mediaId): void
    {
        /** @var Media|null $media */
        $media = $model->morphMany(Media::class, 'relatedModel', 'related_model_type', 'related_model_id')
            ->whereKey($mediaId)
            ->first();

        if ($media === null) {
            throw (new ModelNotFoundException())->setModel(Media::class, [$mediaId]);
        }

        $media->forceFill([
            'related_model_type' => null,
            'related_model_id' => null,
        ])->save();
    }
}
