<?php

namespace App;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Email
{
    static $mailer;
    static $twig;
    protected $user;

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

//        var_dump($user); exit;
    }

    public function send()
    {
        $message = (new \Swift_Message('Your top music from '.date('j M', $this->user->getFromTime()).' — '.date('j M Y', $this->user->getToTime() - 1)))
            ->setFrom('semieway@gmail.com', 'Last.fm Report')
            ->setTo($this->user->getEmail())
            ->setBody(
                self::$twig->render(
                    'base.html.twig',
                    ['user' => $this->user]
                ),
                'text/html'
            );

        self::$mailer->send($message);
    }
}