<?php

declare(strict_types=1);

namespace Erp\MediaPackage\DTO;

use Illuminate\Http\UploadedFile;

readonly class MediaUploadData
{
    public function __construct(
        public UploadedFile $file,
        public ?string $disk = 'public',
        public ?string $directory = ''
    ) {
    }
}
