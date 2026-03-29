<?php

declare(strict_types=1);

namespace Erp\MediaPackage\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasUuids;

    protected $table = 'media';

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'string';

    /**
     * @var list<string>
     */
    protected $fillable = [
        'id',
        'disk',
        'path',
        'filename',
        'mime_type',
        'extension',
        'size',
        'type',
        'related_model_type',
        'related_model_id',
    ];
}
