<?php

namespace Game\Controllers;

use Game\Entities\Character;
use Game\Services\Character\CharacterService;
use R2SSimpleRouter\Response;

class CharacterController
{
    public function index()
    {
        Response::success(
            data: CharacterService::getPaginated()
        );
    }

    public function show(int $userId)
    {
        Response::success(
            data: Character::getRepository()->getByIdOrDie($userId)
        );
    }
}