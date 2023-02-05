<?php

namespace Game\Utils\Traits;

use Game\Repositories\BaseRepository;

trait IsModel
{
    public static function getRepository(): BaseRepository
    {
        $repositoryClass = 'Game\\Repositories\\'.basename(get_called_class()).'Repository';
        return new $repositoryClass();
    }
}