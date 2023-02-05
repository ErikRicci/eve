<?php

namespace Game\Entities;

use Game\Enums\Alignment;

class Pawn
{
    protected int $id;
    protected int $level = 1;
    protected int $experiencePoints = 0;
    protected Alignment $alignment;

    public function getLevel(): int
    {
        return $this->level;
    }

    public function getCalculatedLevel(): int
    {
        return 1 + floor($this->experiencePoints / 80_000);
    }

    public function addExperiencePoints(int $experiencePoints): void
    {
        $this->experiencePoints += $experiencePoints;
    }

    public function levelUp(): void
    {
        $this->level = $this->getCalculatedLevel();
    }
}