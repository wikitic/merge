<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin")
 */
class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="admin_login")
     */
    public function login(AuthenticationUtils $authenticationUtils) : Response
    {
        if($this->getUser())
            return $this->redirectToRoute('sonata_admin_redirect');

        return $this->render('Admin/login.html.twig', array(
            'last_username' => $authenticationUtils->getLastUsername(),
            'error'         => $authenticationUtils->getLastAuthenticationError(),
        ));
    }

    /**
     * @Route("/login_check", name="admin_login_check")
     */
    public function loginCheck() : void
    {
        // el "login check" lo hace Symfony automáticamente
    }

    /**
     * @Route("/logout", name="admin_logout")
     */
    public function logout() : void
    {
        // el logout lo hace Symfony automáticamente
    }
}