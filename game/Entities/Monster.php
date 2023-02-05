<?php

namespace Game\Entities;

use Game\Enums\Alignment;
use Game\Enums\MonsterRace;
use R2SArrayHelper\Traits\CanBeArray;

class Monster extends Pawn {
    use CanBeArray;

    private string $name;
    private MonsterRace $race;

    public function __construct(int $id, string $name, MonsterRace $race, Alignment $alignment) {
        $this->id = $id;
        $this->name = $name;
        $this->race = $race;
        $this->alignment = $alignment;
    }
}
