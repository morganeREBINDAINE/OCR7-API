<?php

namespace App\Subscriber;

use App\Entity\Client;
use App\Entity\Partner;
use App\Services\Mailer;
use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Security;

class ClientSubscriber implements EventSubscriber
{
    private $security;
    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;
    /** @var Mailer */
    private $mailer;

    public function __construct(Security $security, UserPasswordEncoderInterface $encoder, Mailer $mailer)
    {
        $this->security = $security;
        $this->encoder  = $encoder;
        $this->mailer   = $mailer;
    }

    /**
     * Returns an array of events this subscriber wants to listen to.
     *
     * @return string[]
     */
    public function getSubscribedEvents()
    {
        return [
            Events::prePersist
        ];
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $object = $args->getObject();

        if($object instanceof Client) {
            $object->setPartner($this->security->getUser());
        }

        if($object instanceof Partner) {
            $this->mailer->sendSubscriptionMail($object);
        }
    }
}