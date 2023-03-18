<?php

namespace Domains\Module\Casts;

use Domains\Module\ValueObjects\TimeValueObject;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class ModuleTimeCast implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        return new TimeValueObject($value);
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        if (!($value instanceof TimeValueObject)) {
            $value = new TimeValueObject($value);
        }
        return $value->getRawValue();
    }
}
