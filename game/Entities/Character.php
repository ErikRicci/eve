<?php

namespace Game\Entities;

use Game\Entities\Inanimate\Inventory;
use Game\Entities\Inanimate\Item;
use Game\Enums\Alignment;
use Game\Enums\CharacterClass;
use Game\Enums\CharacterRace;
use Game\Utils\Traits\IsModel;
use R2SArrayHelper\Traits\CanBeArray;

class Character extends Pawn
{
    use CanBeArray, IsModel;

    private string $name;
    private CharacterRace $race;
    private CharacterClass $class;
    private string $backstory;
    private Inventory $inventory;

    public function __construct(
        int $id,
        int $level,
        string $name,
        Alignment $alignment,
        CharacterRace $race,
        CharacterClass $class,
        string $backstory,
        Inventory $inventory = null
    ) {
        $this->id = $id;
        $this->level = $level;
        $this->name = $name;
        $this->alignment = $alignment;
        $this->race = $race;
        $this->class = $class;
        $this->backstory = $backstory;
        $this->inventory = $inventory ?: new Inventory();
    }

    public function getInventory(): Inventory
    {
        return $this->inventory;
    }

    public function addItemToInventory(Item $item, int $amount = 1)
    {
        $this->inventory->addItem($item, $amount);
    }
}