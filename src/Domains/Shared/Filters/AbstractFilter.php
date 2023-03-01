<?php
declare(strict_types=1);

namespace Domains\Shared\Filters;

use Illuminate\Contracts\Database\Query\Builder;

abstract class AbstractFilter
{
    abstract public function title(): string;

    abstract public function key(): string;

    abstract public function apply(Builder $builder): Builder;

    abstract public function values(): array;

    abstract public function view(): string;

    /**
     * Get a value from query params
     * @param string|null $index
     * @param mixed|null $default
     * @return mixed
     */
    public function requestValue(string $index = null, mixed $default = null): mixed
    {
        return request(
            "filters." . $this->key() . ($index ? ".{$index}" : ''),
            $default
        );
    }

    public function multipleSelectSelected($value): bool {
        return collect($this->requestValue())->contains($value);
    }

    public function name(string $index = null): string
    {
        return str($this->key())
            ->wrap('[', ']')
            ->prepend('filters')
            ->when($index, fn($str) => $str->append("[{$index}]"))
            ->value();
    }

    public function id(string $index = null): string
    {
        return str($this->name($index))
            ->slug()
            ->value();
    }

    public function __toString(): string
    {
        return view($this->view(), [
            "filter" => $this,
        ])->render();
    }
}
