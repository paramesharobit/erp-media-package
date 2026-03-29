<?php

declare(strict_types=1);

namespace Arobit\ErpMedia\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

final class MediaResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'type' => 'media',
            'id' => $this->resource->getKey(),
            'attributes' => [
                'disk' => $this->resource->disk,
                'directory' => $this->resource->directory,
                'name' => $this->resource->name,
                'mime_type' => $this->resource->mime_type,
                'extension' => $this->resource->extension,
                'size' => $this->resource->size,
                'path' => $this->resource->path,
                'metadata' => $this->resource->metadata,
                'created_at' => $this->resource->created_at,
                'updated_at' => $this->resource->updated_at,
            ],
        ];
    }
}
