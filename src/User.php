<?php

namespace App;

use GuzzleHttp\Client;

class User
{

    /** @var string */
    protected $name;

    /** @var string */
    protected $avatar;

    /** @var string */
    protected $email;

    /** @var array */
    protected $follows = [];

    /** @var array */
    protected $artists = [];

    /** @var array */
    protected $albums = [];

    /** @var array */
    protected $tracks = [];

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getAvatar(): string
    {
        return $this->avatar;
    }

    /**
     * @param string $avatar
     */
    public function setAvatar(): void
    {
        $response = Report::$client->request('GET', '/', [
            'query' => [
                'method' => 'user.getinfo',
                'user' => $this->getName(),
                'format' => 'json',
            ]
        ]);

        $data = json_decode($response);

        $this->avatar = $data->user->image[2]->{'#text'};
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return array
     */
    public function getFollows(): array
    {
        return $this->follows;
    }

    /**
     * @param string $follow
     */
    public function setFollows(string $follow): void
    {
        $user = new User($follow);
        $user->setAvatar();
        $user->setArtists();
        $user->setAlbums();
        $user->setTracks();

        $this->follows[] = $user;
    }

    /**
     * @return array
     */
    public function getArtists(): array
    {
        return $this->artists;
    }

    /**
     * @param string $artists
     */
    public function setArtists(string $artists): void
    {
        $response = Report::$client->request('GET', '/', [
            'query' => [
                'method' => 'user.getweeklyartistchart',
                'user' => $this->getName(),
                'format' => 'json',
            ]
        ]);

        $data = json_decode($response);

        $this->artists = array_slice($data->weeklyartistchart->artist, 0, 5);
    }

    /**
     * @return array
     */
    public function getAlbums(): array
    {
        return $this->albums;
    }

    /**
     * @param string $albums
     */
    public function setAlbums(string $albums): void
    {
        $response = Report::$client->request('GET', '/', [
            'query' => [
                'method' => 'user.getWeeklyAlbumChart',
                'user' => $this->getName(),
                'format' => 'json',
            ]
        ]);

        $data = json_decode($response);

        $this->albums = array_slice($data->weeklyalbumchart->album, 0, 5);
    }

    /**
     * @return array
     */
    public function getTracks(): array
    {
        return $this->tracks;
    }

    /**
     * @param string $tracks
     */
    public function setTracks(string $tracks): void
    {
        $response = Report::$client->request('GET', '/', [
            'query' => [
                'method' => 'user.getWeeklyTrackChart',
                'user' => $this->getName(),
                'format' => 'json',
            ]
        ]);

        $data = json_decode($response);

        $this->tracks = array_slice($data->weeklytrackchart->track, 0, 5);
    }

}