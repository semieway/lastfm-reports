<?php


namespace App;


class Report
{

    protected $apiToken;
    protected $user;

    public function __construct($userInfo)
    {
        $this->apiToken = getenv('API_TOKEN');
        $this->user = $this->setUser($userInfo);

        foreach ($userInfo['follows'] as $follows) {
            $this->user['follows'][] = $this->setUser($follows);
        }
    }

    public function setUser($userInfo)
    {
        $user = new User();
        $user->setName($userInfo['name']);

        return $user;
    }

    public function generate()
    {

    }
}