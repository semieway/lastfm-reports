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
            ->setUsername(getenv('EMAIL_USERNAME'))
            ->setPassword(getenv('EMAIL_PASSWORD'))
            ->setEncryption('SSL');
        static::$mailer = new \Swift_Mailer($transport);
        $loader = new FilesystemLoader(__DIR__ . '/../templates');
        static::$twig = new Environment($loader);

        $this->user = $user;

        $query = pg_query(Database::$connection, 'SELECT * from quotes ORDER BY RANDOM()');
        self::$quote = pg_fetch_array($query, null, PGSQL_ASSOC);
    }

    public function send()
    {
        date_default_timezone_set($this->user->getTimezone());

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