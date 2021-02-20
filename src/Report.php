<?php

namespace App;

use GuzzleHttp\Client;

class Report
{

    protected $users = [];
    static $apiToken;
    static $client;

    public function __construct($usersInfo)
    {
        self::$apiToken = getenv('API_TOKEN');
        self::$client = new Client([
            'base_uri' => 'https://ws.audioscrobbler.com/2.0',
        ]);

        foreach ($usersInfo as $userInfo) {
            $this->users[] = $this->setUser($userInfo);
        }
    }

    public function setUser($userInfo): User
    {
        $user = new User($userInfo['name']);
        $user->setEmail($userInfo['email']);
        $user->setTimezone($userInfo['timezone']);
        $user->setAvatar();
        $user->setArtists();
        $user->setAlbums();
        $user->setTracks();

        foreach (explode(',', $userInfo['follows']) as $follow) {
            $user->setFollows($follow);
        }

        return $user;
    }

    public function generate()
    {
        foreach ($this->users as $user) {
            $email = new Email($user);
            $email->send();
        }
    }
}