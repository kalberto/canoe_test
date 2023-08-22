<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;

trait SaveWithSlug
{
    protected function name(): Attribute
    {
        return Attribute::make(
            set: static fn($value) => ['slug' => Str::slug($value), 'name' => $value]
        );
    }
}
