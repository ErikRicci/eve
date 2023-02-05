<?php

namespace Game\Repositories;

use Game\DTOs\DTO;

interface BaseRepository
{
    public function getAll();
    public function getById(int $id);
    public static function create(DTO $dto);
    public function update($entity);
    public function delete(int $id);
}
