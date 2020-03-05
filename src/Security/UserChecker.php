<?php

namespace App\Security;

use App\Entity\Partner;
use Symfony\Component\Security\Core\Exception\AccountStatusException;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserChecker implements UserCheckerInterface
{

    /**
     * Checks the user account before authentication.
     *
     * @throws AccountStatusException
     */
    public function checkPreAuth(UserInterface $user)
    {
        if (!$user instanceof Partner) {
            return;
        }

        if (null === $user->getSubscriptionToken()->getAccessed() || !$user->getPassword()) {
            throw new BadCredentialsException();
        }
    }

    /**
     * Checks the user account after authentication.
     *
     * @throws AccountStatusException
     */
    public function checkPostAuth(UserInterface $user)
    {
    }
}