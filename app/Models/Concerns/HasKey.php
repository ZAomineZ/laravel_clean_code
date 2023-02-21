<?php

namespace App\Models\Concerns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait HasKey
{
    public static function bootHasKey(): void
    {
        static::creating(
            fn(Model $model) => $model->key = substr(strtolower(class_basename($model)), 0, 3) . '_' . Str::random(12)
        );
    }
}
