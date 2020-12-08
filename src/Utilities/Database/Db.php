<?php

namespace App\Utilities\Database;

use App\Utilities\Traits\SingletonTrait;

class Db
{
    use SingletonTrait;

    /**
     * @var
     */
    public $connection;

    /**
     * @throws \Exception
     */
    public function init()
    {
        $this->connect();
    }

    /**
     * @throws \Exception
     */
    private function connect()
    {
        try {
            $credentials = config('database');

            $dsn = "mysql:dbname={$credentials['dbname']};host={$credentials['host']};port={$credentials['port']}";

            $options = [
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ,
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
            ];

            $db = new \PDO($dsn, $credentials['user'], $credentials['password'], $options);

            $this->connection = $db;
        } catch (\PDOException $e) {
            exit("DB connection failed: {$e->getMessage()}");
        }
    }

    /**
     * @return mixed
     */
    public function getConnection()
    {
        return $this->connection;
    }
}