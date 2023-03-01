<?php
declare(strict_types=1);

use Domains\Shared\Filters\FilterManager;
use Support\Flash\Flash;

if(!function_exists('flash')) {
    function flash(): Flash {
        return app(Flash::class);
    }
}

if (!function_exists('filters')) {
    function filters(string $domain): array {
        return app(FilterManager::class)
            ->items($domain);
    }
}
