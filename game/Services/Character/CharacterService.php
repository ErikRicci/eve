<?php

namespace Game\Services\Character;

use Game\Enums\Backstory;
use Game\Repositories\CharacterRepository;
use R2SStringHelper\Stringer;

class CharacterService
{
    public static function makeBackstory(Backstory ...$backstories): string
    {
        return Stringer::concatenate(array_map(fn ($backstory) => $backstory->value, $backstories));
    }

    public static function getPaginated(int $perPage = 10)
    {
        return CharacterRepository::getAllPaginated($perPage);
    }
}