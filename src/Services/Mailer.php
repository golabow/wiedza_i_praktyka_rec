<?php


namespace App\Services;


use App\Entity\User;

class Mailer
{
    private $mailer;

    private $twig;

    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    public function sendUserInfo(User $user): bool
    {
        $template = $this->twig->load('emails/hello_user.html.twig');
        $content = $template->render(['user' => $user]);
        $message = (new \Swift_Message('Hello Email'))
            ->setFrom('test@example.com')
            ->setTo($user->getEmail())
            ->setBody($content, 'text/html');
        return $this->mailer->send($message);
    }
}