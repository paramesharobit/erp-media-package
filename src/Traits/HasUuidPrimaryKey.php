<?php

declare(strict_types=1);

namespace Arobit\ErpMedia\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait HasUuidPrimaryKey
{
    protected static function bootHasUuidPrimaryKey(): void
    {
        static::creating(function (Model $model): void {
            if (! $model->getKey()) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    public function getIncrementing(): bool
    {
        return false;
    }

    public function getKeyType(): string
    {
        return 'string';
    }
}
