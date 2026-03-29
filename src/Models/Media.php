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

    protected $fillable = [
        'id',
        'file_name',
        'file_path',
        'mime_type',
        'size',
        'type',
        'related_model_type',
        'related_model_id',
    ];
}
