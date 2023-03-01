<?php
declare(strict_types=1);

namespace Domains\Catalog\QueryBuilders;

use Illuminate\Database\Eloquent\Builder;

final class ModuleQueryBuilder extends Builder
{
    public function filtered(): self {
        foreach (filters('catalog') as $filter) {
            $this->query = $filter->apply($this->query);
        }

        return $this;
    }
}
