<?php

namespace App\Controller\api\v1;

use App\Entity\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Security controller
 *
 * @Route("/api/v1")
 */
final class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     * @return JsonResponse
     */
    public function login(): JsonResponse
    {
        $user = $this->getUser();

        return new JsonResponse($user->getRoles());
    }

    /**
     * @Route("/logout", name="logout")
     * @return void
     * @throws \RuntimeException
     */
    public function logout(): void
    {
        throw new \RuntimeException('This should not be reached!');
    }
}
