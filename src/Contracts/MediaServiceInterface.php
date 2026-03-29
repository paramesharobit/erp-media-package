<?php

declare(strict_types=1);

namespace ErpMediaPackage\Contracts;

use ErpMediaPackage\DTO\MediaData;
use Illuminate\Support\Collection;

interface MediaServiceInterface
{
    /**
     * @return array<string, mixed>|object
     */
    public function create(MediaData $payload): mixed;

    /**
     * @return Collection<int, array<string, mixed>|object>
     */
    public function list(): Collection;

    public function delete(string $id): void;
}
