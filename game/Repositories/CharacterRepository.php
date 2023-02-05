<?php

namespace Game\Repositories;

use Game\Exceptions\Database\EntityNotFoundException;
use Game\Singletons\Database;

class CharacterRepository implements BaseRepository
{
    public function getAll()
    {
        $query = "SELECT * FROM characters";
        $content = [];
        $results = Database::getInstance()->getDB()->query($query);
        while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
            $content[] = $row;
        }

        return $content;
    }

    public static function getAllPaginated(int $perPage = 10)
    {
        $page = (request('page') && is_numeric(request('page'))) ? request('page') : 1;
        $from = ($page - 1) * $perPage;

        $query = "SELECT * FROM characters LIMIT {$from}, {$perPage}";
        $result = Database::getInstance()->getDB()->query($query);

        $data = [];
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $data[] = $row;
        }

        return $data;
    }

    public function getById(int $id)
    {
        $query = "SELECT * FROM characters WHERE id = :id";
        $statement = Database::getInstance()->getDB()->prepare($query);
        $statement->bindValue(':id', $id, SQLITE3_INTEGER);
        $result = $statement->execute();

        return $result->fetchArray(SQLITE3_ASSOC);
    }

    public function getByIdOrDie(int $id)
    {
        $result = $this->getById($id);

        if (! $result) {
            throw new EntityNotFoundException("Character $id not found on database!");
        }

        return $result;
    }

    public static function create($entity)
    {
        // TODO: Implement create() method.
    }

    public function update($entity)
    {
        // TODO: Implement update() method.
    }

    public function delete(int $id)
    {
        // TODO: Implement delete() method.
    }
}