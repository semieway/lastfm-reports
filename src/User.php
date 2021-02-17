<?php


namespace App;


class User
{

    /** @var string */
    protected $name;

    /** @var string */
    protected $avatar;

    /** @var string */
    protected $email;

    /** @var string */
    protected $follows;

    /** @var string */
    protected $artists;

    /** @var string */
    protected $albums;

    /** @var string */
    protected $tracks;

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
    public function setAvatar(string $avatar): void
    {
        $this->avatar = $avatar;
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
     * @return string
     */
    public function getFollows(): string
    {
        return $this->follows;
    }

    /**
     * @param string $follows
     */
    public function setFollows(string $follows): void
    {
        $this->follows = $follows;
    }

    /**
     * @return string
     */
    public function getArtists(): string
    {
        return $this->artists;
    }

    /**
     * @param string $artists
     */
    public function setArtists(string $artists): void
    {
        $this->artists = $artists;
    }

    /**
     * @return string
     */
    public function getAlbums(): string
    {
        return $this->albums;
    }

    /**
     * @param string $albums
     */
    public function setAlbums(string $albums): void
    {
        $this->albums = $albums;
    }

    /**
     * @return string
     */
    public function getTracks(): string
    {
        return $this->tracks;
    }

    /**
     * @param string $tracks
     */
    public function setTracks(string $tracks): void
    {
        $this->tracks = $tracks;
    }

}