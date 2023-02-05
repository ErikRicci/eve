<?php

namespace Game\Repositories;

use Game\DTOs\DTO;
use Game\DTOs\UserDTO;
use Game\Exceptions\Database\EntityNotFoundException;
use Game\Singletons\Database;

class UserRepository implements BaseRepository
{
    private array $queryParams = [];

    public function getAll()
    {
        $query = "SELECT * FROM users {$this->getQueryParams()}";
        $content = [];
        $results = Database::getInstance()->getDB()->prepare($query);
        foreach ($this->getQueryParams() as $param => $value) {

        }
        $results = $results->execute();
        while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
            $content[] = $row;
        }

        return $content;
    }

    public function getAllPaginated(int $perPage = 10)
    {
        $page = (request('page') && is_numeric(request('page'))) ? request('page') : 1;
        $from = ($page - 1) * $perPage;

        $query = "SELECT * FROM users LIMIT {$from}, {$perPage}";
        $result = Database::getInstance()->getDB()->query($query);

        $data = [];
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $data[] = $row;
        }

        return $data;
    }

    public function getById(int $id)
    {
        $query = "SELECT * FROM users WHERE id = :id";
        $statement = Database::getInstance()->getDB()->prepare($query);
        $statement->bindValue(':id', $id, SQLITE3_INTEGER);
        $result = $statement->execute();

        return $result->fetchArray(SQLITE3_ASSOC);
    }

    public function getByIdOrDie(int $id)
    {
        $result = $this->getById($id);

        if (! $result) {
            throw new EntityNotFoundException("User $id not found on database!");
        }

        return $result;
    }

    public static function getByLoginAndPassword(string $login, string $password)
    {
        return (new self)->where(['login' => $login, 'password' => $password])->getAll();
    }

    public static function create(DTO $userDTO)
    {
        $query = "INSERT INTO users(login, password) VALUES(:login, :password)";
        $statement = Database::getInstance()->getDB()->prepare($query);
        $statement->bindValue(':login', $userDTO->login);
        $statement->bindValue(':password', $userDTO->password);

        return $statement->execute();
    }

    public function update($entity)
    {
        // TODO: Implement update() method.
    }

    public function delete(int $id)
    {
        // TODO: Implement delete() method.
    }

    public function where(array $conditions = ['1' => '1'])
    {
        $andArray = [];
        foreach ($conditions as $column => $value) {
            $andArray[] = ":$column = $value";
        }

        if ($this->queryParams) {
            $this->queryParams .= implode(' AND ', $andArray);
        } else {
            $this->queryParams = 'WHERE ' . implode(' AND ', $andArray);
        }

        dd($andArray);

        return $this;
    }

    private function getQueryParams()
    {
        return $this->queryParams ?: 'WHERE 1 = 1';
    }
}