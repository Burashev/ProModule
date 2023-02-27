<?php
declare(strict_types=1);

namespace App\Menu;

final class Menu
{
    private MenuCollection $items;

    public function __construct()
    {
        $this->items = new MenuCollection();
    }

    public function addItem(MenuItem $item): self
    {
        $this->items->add($item);
        return $this;
    }

    public function addItemIf(bool $condition, MenuItem $item): self
    {
        if ($condition) $this->addItem($item);
        return $this;
    }

    public function all(): MenuCollection
    {
        return $this->items;
    }
}
