<?php

namespace App\Controller\api\v1;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;

/**
 * Security controller
 *
 * @Route("/api/v1")
 */
final class SecurityController extends AbstractController
{
    /**
     * @Route("/login", methods={"POST"})
     *
     * @return JsonResponse
     */
    public function login(): JsonResponse
    {
        return new JsonResponse(
            [
                'user' => $this->getUser()
            ]
        );
    }

    /**
     * @Route("/logout", methods={"GET"})
     *
     * @return void
     * @throws \RuntimeException
     */
    public function logout(): void
    {
        throw new \RuntimeException('This should not be reached!');
    }
}
