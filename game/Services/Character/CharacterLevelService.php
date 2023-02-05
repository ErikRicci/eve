<?php

namespace Game\Services\Character;

use Game\Entities\Character;

class CharacterLevelService
{
    public static function characterMayLevelUp(Character $character): bool
    {
        return $character->getLevel() < $character->getCalculatedLevel();
    }
}