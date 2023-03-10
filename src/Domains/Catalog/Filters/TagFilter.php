<?php
declare(strict_types=1);

namespace Domains\Catalog\Filters;

use Domains\Module\Models\TagType;
use Domains\Shared\Filters\AbstractFilter;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;

final class TagFilter extends AbstractFilter
{
    public function title(): string
    {
        return "Теги";
    }

    public function key(): string
    {
        return "tags";
    }

    public function apply(Builder $builder): Builder
    {
        return $builder->when($this->requestValue(), function (Builder $builder) {
            foreach ($this->requestValue() as $key => $values) {
                $builder->whereHas('tags', function (Builder $builder) use ($key, $values) {
                    $builder->whereHas('tagType', function (Builder $builder) use ($key) {
                        $builder->where('name', $key);
                    })->whereIn('tags.id', $values);
                });
            }
        });
    }

    public function values(): array|\Countable
    {
        return Cache::tags('tag_types')->rememberForever('filtered_tag_types', function () {
            return TagType::query()
                ->select(['id', 'name', 'title'])
                ->with(['tags'])
                ->where('is_filtered', true)
                ->get();
        });
    }

    public function view(): string
    {
        return "domains.catalog.filters.tags";
    }
}
