<?php

namespace Game\Entities;

use Game\Entities\Inanimate\Inventory;
use Game\Entities\Inanimate\Item;
use Game\Enums\Alignment;
use Game\Enums\CharacterClass;
use Game\Enums\CharacterRace;
use Game\Utils\Traits\IsModel;
use R2SArrayHelper\Traits\CanBeArray;

class User extends Pawn
{
    use CanBeArray, IsModel;
}