<?php

namespace App\Controller\api\v1;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Security controller
 *
 * @Route("/api/v1")
 */
final class SecurityController extends AbstractController
{
    /** @var SerializerInterface */
    private $serializer;

    /**
     * @param SerializerInterface $serializer
     */
    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @Route("/login", methods={"POST"})
     *
     * @return JsonResponse
     */
    public function login(): JsonResponse
    {
        /*
        //use App\Entity\Language;
        //use App\BundlePartner\Entity\Partner;
        $languages = $this->getDoctrine()->getRepository(Language::class, 'default')->findAll();
        $partners = $this->getDoctrine()->getRepository(Partner::class, 'partner')->findAll();
        */

        return new JsonResponse(
            $this->serializer->serialize($this->getUser(), 'json'),
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
