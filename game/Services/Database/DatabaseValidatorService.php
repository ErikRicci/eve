<?php

namespace Game\Services\Database;

use Game\Repositories\BaseRepository;

class DatabaseValidatorService
{
    public static function checkExists(BaseRepository $repository, array $conditions = []): bool
    {
        return $repository->where($conditions)->exists();
    }
}