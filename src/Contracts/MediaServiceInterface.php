<?php

declare(strict_types=1);

namespace Erp\MediaPackage\Contracts;

use Erp\MediaPackage\DTO\MediaUploadData;
use Erp\MediaPackage\Models\Media;

interface MediaServiceInterface
{
    public function upload(MediaUploadData $uploadData): Media;

    public function safeDelete(string $mediaId): bool;
}
