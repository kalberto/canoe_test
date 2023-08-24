<?php

namespace App\Traits;

trait SaveToUpper
{
    public function setAttribute($key, $value): void
    {
        parent::setAttribute($key, $value);

        if (is_string($value)) {
            $this->attributes[$key] = strtoupper(trim($value));
        }
    }
}
