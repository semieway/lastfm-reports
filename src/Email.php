<?php

namespace App;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Email
{
    static $mailer;
    static $twig;
    protected $user;
    static $quote;

    public function __construct(User $user)
    {
        $transport = (new \Swift_SmtpTransport('smtp.gmail.com', 465))
            ->setUsername('semieway@gmail.com')
            ->setPassword('akhucdrfwsgatdym')
            ->setEncryption('SSL');
        static::$mailer = new \Swift_Mailer($transport);
        $loader = new FilesystemLoader(__DIR__ . '/../templates');
        static::$twig = new Environment($loader);

        $this->user = $user;

        $query = pg_query(Database::$connection, 'SELECT * from quotes WHERE sent = FALSE ORDER BY RANDOM()');
        if (!isset(self::$quote)) {
            self::$quote = pg_fetch_array($query, null, PGSQL_ASSOC);
            $res = pg_update(Database::$connection, 'quotes', ['sent' => TRUE], ['id' => self::$quote['id']]);
        }
    }

    public function send()
    {
        date_default_timezone_set($this->user->getTimezone());
        $follows = $this->user->getFollows();
        usort($follows, function ($a, $b) { return ($a > $b) ? -1 : 1; });
        $this->user->follows = $follows;

        $message = (new \Swift_Message('Your top music from '.date('j M', $this->user->getFromTime()).' — '.date('j M Y', $this->user->getToTime() - 1)))
            ->setFrom('semieway@gmail.com', 'Last.fm Report')
            ->setTo($this->user->getEmail())
            ->setBody(
                self::$twig->render(
                    'base.html.twig',
                    [
                        'user' => $this->user,
                        'quote' => self::$quote
                    ]
                ),
                'text/html'
            );

        self::$mailer->send($message);
    }
}