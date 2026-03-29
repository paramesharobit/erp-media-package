<?php

declare(strict_types=1);

namespace Erp\MediaPackage\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasUuids;

    protected $table = 'media';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'disk',
        'directory',
        'original_name',
        'filename',
        'path',
        'mime_type',
        'extension',
        'size',
    ];
}
