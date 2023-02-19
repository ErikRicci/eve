<?php

namespace Game\Entities;

use Game\Entities\Inanimate\Inventory;
use Game\Entities\Inanimate\Item;
use Game\Enums\Alignment;
use Game\Enums\CharacterClass;
use Game\Enums\CharacterRace;
use Game\Utils\Traits\IsModel;
use R2SArrayHelper\Traits\CanBeArray;

class User
{
    use CanBeArray, IsModel;

    public function __construct(
        public int $id = 0,
        public string $login = '',
        public string $password = '',
        public string $created_at = '',
    ) {}
}