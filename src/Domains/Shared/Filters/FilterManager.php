<?php
declare(strict_types=1);

namespace Domains\Shared\Filters;

final class FilterManager
{
    public function __construct(private array $items = [])
    {
    }

    public function registerFilters(string $domain, array $items): void
    {
        $this->items[$domain] = $items;
    }

    public function items(string $domain): array
    {
        return $this->items[$domain];
    }
}
