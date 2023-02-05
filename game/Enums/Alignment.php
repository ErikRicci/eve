<?php

namespace Game\Enums;

enum Alignment: string
{
    case LAWFUL_GOOD = 'Lawful Good';
    case NEUTRAL_GOOD = 'Neutral Good';
    case CHAOTIC_GOOD = 'Chaotic Good';
    case LAWFUL_NEUTRAL = 'Lawful Neutral';
    case TRUE_NEUTRAL = 'True Neutral';
    case CHAOTIC_NEUTRAL = 'Chaotic Neutral';
    case LAWFUL_EVIL = 'Lawful Evil';
    case NEUTRAL_EVIL = 'Neutral Evil';
    case CHAOTIC_EVIL = 'Chaotic Evil';
}