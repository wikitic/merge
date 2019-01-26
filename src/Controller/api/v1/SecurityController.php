<?php

namespace App\Controller\api\v1;

use App\BundlePartner\Entity\Partner;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use Doctrine\ORM\EntityManagerInterface;
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
        $partner = $this->getUser();

        $partner = $this->getDoctrine()->getRepository(Partner::class, 'partner')->serialize($partner);

        return new JsonResponse(
            $partner,
            Response::HTTP_OK,
            [],
            true
        );
    }

    /**
     * @Route("/logout", methods={"GET"})
     * @Security("is_granted('ROLE_PARTNER')")
     *
     * @return void
     * @throws \RuntimeException
     */
    public function logout(): void
    {
        throw new \RuntimeException('This should not be reached!');
    }
}
