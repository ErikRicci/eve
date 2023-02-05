<?php

namespace Game\Entities\Inanimate;

use R2SArrayHelper\Traits\CanBeArray;

class Item
{
    use CanBeArray;

    private string $name;
    private string $value;

    public function __construct(string $name, string $value)
    {
        $this->name = $name;
        $this->value = $value;
    }
}