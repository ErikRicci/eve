<?php

namespace Game\Repositories;

use Game\DTOs\DTO;
use Game\DTOs\UserDTO;
use Game\Exceptions\Database\EntityNotFoundException;
use Game\Singletons\Database;

class UserRepository implements BaseRepository
{
    private array $queryColumns = ['*'];
    private array $queryParams = [];

    public function getSingle(): ?array
    {
        $query = "SELECT {$this->getQueryColumnsAsString()} FROM users WHERE {$this->getQueryParamsAsString()} LIMIT 1";
        $content = [];
        $results = Database::getInstance()->getDB()->prepare($query);
        foreach (array_values($this->getQueryParams()) as $i => $value) {
            $results->bindValue($i + 1, $value);
        }
        $results = $results->execute();
        while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
            $content[] = $row;
        }

        return array_key_exists(0, $content)
            ? $content[0]
            : null;
    }

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

    public static function getByLoginAndPassword(string $login, string $password): ?array
    {
        return (new self)
            ->select('id,login,created_at')
            ->where(
                [
                    'login' => $login,
                    'password' => $password,
                ]
            )
            ->getSingle();
    }

    public static function getByLogin(string $login): ?array
    {
        return (new self)->where(['login' => $login])->getSingle();
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

    public function select(array|string $columns): static
    {
        if (is_array($columns)) {
            $this->queryColumns = $columns;
        } else {
            $this->queryColumns = explode(',', $columns);
        }

        return $this;
    }

    public function where(array|string $conditions, mixed $value = null): static
    {
        $conditionsArray = is_array($conditions)
            ? $conditions
            : [$conditions => $value];

        $this->queryParams = array_merge($this->queryParams, $conditionsArray);

        return $this;
    }

    private function getQueryColumns(): array
    {
        return $this->queryColumns;
    }

    private function getQueryColumnsAsString(): string
    {
        return implode(' ,', $this->queryColumns);
    }

    private function getQueryParams(): array
    {
        return $this->queryParams;
    }

    private function getQueryParamsAsString(): string
    {
        $andArray = [];
        foreach (array_keys($this->queryParams) as $column) {
            $andArray[] = "$column = ?";
        }
        return implode(' AND ', $andArray);
    }
}