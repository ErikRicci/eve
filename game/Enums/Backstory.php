<?php

namespace Game\Enums;

enum Backstory: string
{
    case HIDDEN_POWER = 'As a child, something has awaken inside their soul. Something which will only be found later.';
    case ORPHAN = 'Never met one or more of their parents. Was abandoned or saw them die.';
    case POOR = 'Was poor when young. Never had any heritage nor had anything to call their own.';
    case LOVING_PARENTS = 'Had their parents until they were really old. They died happy and smiling.';
    case COMMON_WEALTH = 'Money was not the problem. At least not all the time. Earned a small heritage.';
}