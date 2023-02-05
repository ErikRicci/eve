<?php

namespace Game\Entities;

class Power
{
    private string $name;
    private string $description;
    private int $manaCost;
    private float $damage;
    private int $minLevelRequired;

    public function __construct(string $name, string $description, int $manaCost, float $damage, int $minLevelRequired)
    {
        $this->name = $name;
        $this->description = $description;
        $this->manaCost = $manaCost;
        $this->damage = $damage;
        $this->minLevelRequired = $minLevelRequired;
    }

    public function getExplainText(): string
    {
        return <<<TEXT
        $this->name ($this->manaCost MP)
        $this->description
        DAMAGE: $this->damage [MIN LEVEL: $this->minLevelRequired]
        TEXT;

    }
}