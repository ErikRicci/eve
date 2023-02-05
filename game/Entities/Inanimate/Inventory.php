<?php

namespace Game\Entities\Inanimate;

use Game\Entities\Inanimate\Item;
use Game\Exceptions\Inventory\InventoryIsFullException;
use Game\Exceptions\Inventory\InventoryItemNotFoundException;
use R2SArrayHelper\Traits\CanBeArray;

class Inventory
{
    use CanBeArray;

    private int $size;
    private array $items;

    public function __construct(
        int $size = 10,
        array $items = []
    ) {
        $this->size = $size;
        $this->items = $items;
    }

    /**
     * @return Item[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    public function addItem(Item $item, int $amount = 1): void
    {
        for ($i = 0; $i < $amount; $i++) {
            $this->items[] = $item;
        }

        if (sizeof($this->items) > $this->size) {
            throw new InventoryIsFullException('Inventory has reached its full capacity');
        }
    }

    public function getItemAt(int $index): Item
    {
        if (! array_key_exists($index, $this->items)) {
            throw new InventoryItemNotFoundException("Item $index not found");
        }

        return $this->items[$index];
    }
}