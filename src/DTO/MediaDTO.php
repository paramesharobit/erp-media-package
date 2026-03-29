<?php

declare(strict_types=1);

namespace Erp\MediaPackage\DTO;

use Illuminate\Http\UploadedFile;

final readonly class MediaDTO
{
    public function __construct(
        public UploadedFile $file,
        public string $type,
        public ?string $related_model_type = null,
        public ?string $related_model_id = null,
    ) {
    }
}
