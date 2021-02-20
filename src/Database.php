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
            ['name' => 'semieway', 'email' => 'semieway@gmail.com', 'follows' => 'fllwurdrms', 'timezone' => 'Asia/Yekaterinburg'],
            ['name' => 'fllwurdrms', 'email' => 'semieway@yandex.ru', 'follows' => 'semieway', 'timezone' => 'Asia/Yekaterinburg']
        ];
    }
}