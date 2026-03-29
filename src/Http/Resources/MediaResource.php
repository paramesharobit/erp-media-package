<?php

declare(strict_types=1);

namespace ErpMediaPackage\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

final class MediaResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'media',
            'id' => (string) data_get($this->resource, 'id'),
            'attributes' => [
                'name' => data_get($this->resource, 'name'),
                'collection' => data_get($this->resource, 'collection'),
                'mime_type' => data_get($this->resource, 'mime_type'),
                'size' => data_get($this->resource, 'size'),
                'url' => data_get($this->resource, 'url'),
                'created_at' => data_get($this->resource, 'created_at'),
            ],
        ];
    }
}
