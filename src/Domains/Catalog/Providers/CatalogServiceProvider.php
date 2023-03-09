<?php

namespace Domains\Catalog\Providers;

use Domains\Catalog\Filters\AuthorFilter;
use Domains\Catalog\Filters\SkillFilter;
use Domains\Catalog\Filters\TagFilter;
use Domains\Shared\Filters\FilterManager;
use Illuminate\Support\ServiceProvider;

class CatalogServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        app(FilterManager::class)
            ->registerFilters('catalog', [
                new SkillFilter(),
                new AuthorFilter(),
                new TagFilter()
            ]);
    }
}
