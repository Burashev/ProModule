<?php
declare(strict_types=1);

namespace Domains\Catalog\Filters;

use Domains\Shared\Enums\RolesEnum;
use Domains\Shared\Filters\AbstractFilter;
use Domains\Shared\Models\User;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;

final class AuthorFilter extends AbstractFilter
{
    public function title(): string
    {
        return "Авторы";
    }

    public function key(): string
    {
        return "users";
    }

    public function apply(Builder $builder): Builder
    {
        return $builder->when($this->requestValue(), function (Builder $builder) {
            $builder->whereIn('user_id', $this->requestValue());
        });
    }

    public function values(): array
    {
        return Cache::tags('users')->rememberForever('authors', function () {
            return User::query()
                ->select(['id'])
                ->with(['bio'])
                ->where('role_id', RolesEnum::EXPERT_ID->value)
                ->get()
                ->pluck("bio.name", "id")
                ->toArray();
        });
    }

    public function view(): string
    {
        return "domains.catalog.filters.author";
    }
}
