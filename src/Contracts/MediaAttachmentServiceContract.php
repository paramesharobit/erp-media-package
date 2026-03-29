<?php

declare(strict_types=1);

namespace Erp\MediaPackage\Contracts;

use Erp\MediaPackage\Models\Media;
use Illuminate\Database\Eloquent\Model;

interface MediaAttachmentServiceContract
{
    public function attach(Model $model, string $mediaId): Media;

    public function detach(Model $model, string $mediaId): void;
}
