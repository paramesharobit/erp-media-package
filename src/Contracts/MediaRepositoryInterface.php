<?php

declare(strict_types=1);

namespace Erp\MediaPackage\Contracts;

use Erp\MediaPackage\Models\Media;

interface MediaRepositoryInterface
{
    /**
     * @param array<string, mixed> $attributes
     */
    public function create(array $attributes): Media;

    public function findById(string $id): ?Media;

    public function delete(string $id): bool;

    public function updateRelations(string $id, ?string $relatedModelType, ?string $relatedModelId): Media;
}
