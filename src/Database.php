<?php


namespace App;


class Database
{

    private $url;

    public function __construct()
    {
        //$this->url = '';
        //return database object;
    }

    public function getUsers(): array
    {
        return [
            ['name' => 'semieway', 'following' => 'fllwurdrms'],
            ['name' => 'fllwurdrms', 'following' => 'semieway']
        ];
    }
}