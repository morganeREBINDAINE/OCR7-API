<?php

namespace App\Security;

use App\Entity\Partner;
use App\Repository\PartnerRepository;
use Lexik\Bundle\JWTAuthenticationBundle\Security\Guard\JWTTokenAuthenticator as BaseAuthenticator;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\TokenExtractor\TokenExtractorInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class JWTTokenAuthenticator extends BaseAuthenticator
{
    /**
     * @var PartnerRepository
     */
    private $partnerRepository;

    public function __construct(JWTTokenManagerInterface $jwtManager, EventDispatcherInterface $dispatcher, TokenExtractorInterface $tokenExtractor, PartnerRepository $partnerRepository)
    {
        parent::__construct($jwtManager, $dispatcher, $tokenExtractor);
        $this->partnerRepository = $partnerRepository;
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        return $user instanceof Partner && $user->getSubscriptionToken()->getAccessed() !== null;
    }
}