<?php

namespace Game\Singletons;

class Database
{
    private static ?Database $instance = null;
    private \SQLite3 $db;

    private function __construct()
    {
        $this->db = new \SQLite3('mydatabase.db');
    }

    public static function getInstance(): ?Database
    {
        if (self::$instance === null) {
            self::$instance = new Database();
        }

        return self::$instance;
    }

    public function getDB(): \SQLite3
    {
        return $this->db;
    }
}