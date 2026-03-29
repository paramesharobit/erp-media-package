<?php

declare(strict_types=1);

namespace Arobit\ErpMedia\DTOs;

use Illuminate\Http\UploadedFile;

final readonly class StoreMediaData
{
    public function __construct(
        public UploadedFile $file,
        public ?string $disk,
        public ?string $directory,
        public ?string $visibility,
    ) {
    }
}
