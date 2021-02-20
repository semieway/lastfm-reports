<?php


namespace App;


class Database
{

    static $connection;

    public function __construct()
    {
        self::$connection = pg_connect(getenv('DATABASE_URL'));
    }

    public function getUsers(): array
    {
        $query = pg_query(self::$connection, 'SELECT * from users');
        return pg_fetch_all($query, PGSQL_ASSOC);
    }
}