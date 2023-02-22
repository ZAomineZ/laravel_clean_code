<?php

declare(strict_types=1);

namespace Domain\Blogging\Models\Concerns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait IsPost
{
    public static function bootIsPost(): void
    {
        self::creating(function (Model $model) {
            $model->key = substr(strtolower(class_basename($model)), 0, 3) . '_' . Str::random(12);
            $model->slug = Str::slug($model->title);
        });
    }
}
