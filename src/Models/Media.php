<?php

declare(strict_types=1);

namespace Erp\MediaPackage\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Media extends Model
{
    use HasUuids;

    protected $table = 'media';

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $guarded = [];

    /**
     * @return MorphTo<Model, static>
     */
    public function relatedModel(): MorphTo
    {
        return $this->morphTo('relatedModel', 'related_model_type', 'related_model_id');
    }
}
