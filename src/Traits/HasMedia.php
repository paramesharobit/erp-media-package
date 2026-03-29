<?php

declare(strict_types=1);

namespace Erp\MediaPackage\Traits;

use Erp\MediaPackage\Contracts\MediaAttachmentServiceContract;
use Erp\MediaPackage\Models\Media;
use Erp\MediaPackage\Services\MediaAttachmentService;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasMedia
{
    /**
     * @return MorphMany<Media, $this>
     */
    public function media(): MorphMany
    {
        return $this->morphMany(Media::class, 'relatedModel', 'related_model_type', 'related_model_id');
    }

    public function attachMedia(string $mediaId): Media
    {
        return $this->mediaAttachmentService()->attach($this, $mediaId);
    }

    public function detachMedia(string $mediaId): void
    {
        $this->mediaAttachmentService()->detach($this, $mediaId);
    }

    protected function mediaAttachmentService(): MediaAttachmentServiceContract
    {
        if (function_exists('app')) {
            return app(MediaAttachmentServiceContract::class);
        }

        return new MediaAttachmentService();
    }
}
