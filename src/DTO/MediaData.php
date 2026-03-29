<?php

declare(strict_types=1);

namespace ErpMediaPackage\DTO;

use Illuminate\Http\UploadedFile;

final readonly class MediaData
{
    public function __construct(
        public UploadedFile $file,
        public ?string $collection,
        public ?string $name,
    ) {
    }

    /**
     * @param array<string, mixed> $validated
     */
    public static function fromStoreRequest(array $validated): self
    {
        return new self(
            file: $validated['file'],
            collection: $validated['collection'] ?? null,
            name: $validated['name'] ?? null,
        );
    }
}
