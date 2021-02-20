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
            ->setUsername('semieway@gmail.com')
            ->setPassword('akhucdrfwsgatdym')
            ->setEncryption('SSL');
        static::$mailer = new \Swift_Mailer($transport);
        $loader = new FilesystemLoader(__DIR__ . '/../templates');
        static::$twig = new Environment($loader);

        $this->user = $user;

//        var_dump($user); exit;
    }

    public function send()
    {
        $message = (new \Swift_Message('Last.fm report'))
            ->setFrom('semieway@gmail.com', 'Last.fm')
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