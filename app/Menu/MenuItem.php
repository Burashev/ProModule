<?php
declare(strict_types=1);

namespace App\Menu;

final class MenuItem
{
    public function __construct(public string $title, public string $url)
    {

    }

    public function isActive(): bool
    {
        $path = parse_url($this->url, PHP_URL_PATH) ?? '/';

        if ($path === "/") {
            return request()->path() === "/";
        }
        return request()->fullUrlIs($this->url . "*");
    }
}
