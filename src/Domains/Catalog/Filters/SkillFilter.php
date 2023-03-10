<?php
declare(strict_types=1);

namespace Domains\Catalog\Filters;

use Domains\Catalog\Models\Skill;
use Domains\Shared\Filters\AbstractFilter;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;

final class SkillFilter extends AbstractFilter
{
    public function title(): string
    {
        return "Компетенции";
    }

    public function key(): string
    {
        return "skills";
    }

    public function apply(Builder $builder): Builder
    {
        return $builder->when($this->requestValue(), function (Builder $builder) {
            $builder->whereIn('skill_id', $this->requestValue());
        });
    }

    public function values(): array
    {
        return Cache::tags('skills')->rememberForever('skills', function () {
            return Skill::query()
                ->select(['id', 'title'])
                ->get()
                ->pluck("title", "id")
                ->toArray();
        });
    }

    public function view(): string
    {
        return "domains.catalog.filters.skill";
    }
}
