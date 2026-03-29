<?php

declare(strict_types=1);

namespace Arobit\ErpMedia\Repositories;

use Arobit\ErpMedia\Contracts\MediaRepositoryContract;
use Arobit\ErpMedia\DTOs\StoreMediaData;
use Arobit\ErpMedia\Models\Media;

final class MediaRepository implements MediaRepositoryContract
{
    public function create(StoreMediaData $data): Media
    {
        $path = $data->file->store(
            path: trim((string) $data->directory, '/'),
            options: [
                'disk' => $data->disk,
                'visibility' => $data->visibility,
            ],
        );

        return Media::query()->create([
            'disk' => $data->disk,
            'directory' => $data->directory,
            'name' => $data->file->getClientOriginalName(),
            'mime_type' => $data->file->getClientMimeType(),
            'extension' => $data->file->extension(),
            'size' => $data->file->getSize(),
            'path' => $path,
            'metadata' => [],
        ]);
    }
}
