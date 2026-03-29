<?php

declare(strict_types=1);

namespace Arobit\ErpMedia\Contracts;

use Arobit\ErpMedia\DTOs\StoreMediaData;
use Arobit\ErpMedia\Models\Media;

interface MediaServiceContract
{
    public function store(StoreMediaData $data): Media;
}
