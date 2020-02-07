<?php

namespace App\Subscriber;

use App\Entity\Client;
use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Csrf\TokenStorage\TokenStorageInterface;

class ClientSubscriber implements EventSubscriber
{

    /**
     * @var SessionInterface
     */
    private $storage;

    public function __construct($storage)
    {
        $this->storage = $storage;
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
        $client = $args->getObject();

        if($client instanceof Client) {
            $client->setPartner($this->storage->getToken()->getUser());
        }
    }
}