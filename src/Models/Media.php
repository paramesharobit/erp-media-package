<?php

declare(strict_types=1);

namespace Arobit\ErpMedia\Models;

use Arobit\ErpMedia\Traits\HasUuidPrimaryKey;
use Illuminate\Database\Eloquent\Model;

final class Media extends Model
{
    use HasUuidPrimaryKey;

    protected $table = 'erp_media';

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'size' => 'integer',
            'metadata' => 'array',
        ];
    }
}
