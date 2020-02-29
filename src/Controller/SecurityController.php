<?php

namespace App\Controller;

use App\Entity\Token;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Validator\Constraints\Length;

class SecurityController extends AbstractController
{
    /**
     * @Route("/validation/{token}", name="validation")
     */
    public function validate(Token $subscriptionToken, Request $request, UserPasswordEncoderInterface $encoder): Response
    {
        $partner = $subscriptionToken->getPartner();
        $form = $this->createFormBuilder($partner)
            ->add('name', TextType::class, [
                'label' => 'Nom de l\'entreprise'
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Mot de passe',
                'constraints' => [
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Le mot de passe doit contenir au moins 6 caractères.'
                    ])
                ]
            ])
            ->getForm()
        ;

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $subscriptionToken->setAccessed(new \DateTime());
            $password = $encoder->encodePassword($partner, $partner->getPassword());
            $partner->setPassword($password);
            $this->addFlash('success', 'Votre compte est désormais actif.');
            return $this->redirectToRoute('home');
        }

        return $this->render('security/validation.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('easyadmin');
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \Exception('This method can be blank - it will be intercepted by the logout key on your firewall');
    }
}
