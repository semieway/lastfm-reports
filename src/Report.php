<?php

namespace App;

use GuzzleHttp\Client;

class Report
{

    protected $users = [];
    protected $apiToken;
    static $client;

    public function __construct($usersInfo)
    {
        $this->apiToken = getenv('API_TOKEN');
        self::$client = new Client([
            'base_uri' => 'http://ws.audioscrobbler.com/2.0' ,
            'query' => ['api_key' => $this->apiToken]
        ]);

        foreach ($usersInfo as $userInfo) {
            $this->users[] = $this->setUser($userInfo);
        }
    }

    public function setUser($userInfo): User
    {
        $user = new User($userInfo['name']);
        $user->setEmail($userInfo['email']);
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

    }
}