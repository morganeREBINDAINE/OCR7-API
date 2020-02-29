<?php

namespace App\Services;

use App\Entity\{Partner};
use App\Repository\TokenRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class Mailer
{
    /** @var UrlGeneratorInterface */
    private $router;
    /** @var MailerInterface */
    private $mailer;
    /** @var TokenRepository */
    private $tokenRepository;
    /** @var EntityManagerInterface */
    private $entityManager;

    /**
     * @param UrlGeneratorInterface  $router
     * @param MailerInterface        $mailer
     * @param TokenRepository        $tokenRepository
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(UrlGeneratorInterface $router, MailerInterface $mailer, TokenRepository $tokenRepository, EntityManagerInterface $entityManager)
    {
        $this->router = $router;
        $this->mailer = $mailer;
        $this->tokenRepository = $tokenRepository;
        $this->entityManager = $entityManager;
    }

    public function sendSubscriptionMail(Partner $partner)
    {
        $url = $this->router->generate('validation', [
            'token' => $partner->getSubscriptionToken()->getToken(),
        ], UrlGeneratorInterface::ABSOLUTE_URL);

        $email = (new Email())
            ->from('contact@bilemo.com')
            ->to($partner->getEmail())
            ->subject('Merci de valider votre compte')
            ->text('Validation du compte')
            ->html('<p>Cliquez ici pour mettre à jour vos informations et valider le compte: <a href="'.$url.'">'.$url.'</a> </p>');

        $this->mailer->send($email);
    }
}
