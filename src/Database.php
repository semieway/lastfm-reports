<?php


namespace App;


class Database
{

    private $connection;

    public function __construct()
    {
        $this->connection = pg_connect(getenv('DATABASE_URL'));
    }

    public function getUsers(): array
    {
        $query = pg_query($this->connection, 'SELECT * from users');
        return pg_fetch_all($query, PGSQL_ASSOC);
    }
}