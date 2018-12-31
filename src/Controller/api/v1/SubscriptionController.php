<?php

namespace App\Controller\api\v1;

use App\Entity\Subscription;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\SerializerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;

/**
 * Subscription controller
 *
 * @Route("/api/v1")
 *
 * @IsGranted("IS_AUTHENTICATED_FULLY")
 */
final class SubscriptionController extends AbstractController
{
    /** @var EntityManagerInterface */
    private $em;
    private $er;

    /** @var SerializerInterface */
    private $serializer;

    /**
     * @param EntityManagerInterface $em
     * @param SerializerInterface $serializer
     */
    public function __construct(EntityManagerInterface $em, SerializerInterface $serializer)
    {
        $this->em = $em;
        $this->er = $em->getRepository(Subscription::class);
        $this->serializer = $serializer;
    }


    /**
     * @Rest\Get("/partners/{id_partner}/subscriptions", name="getSubscriptions")
     * @param string $id_partner
     * @return JsonResponse
     */
    public function getSubscriptions(string $id_partner = null): JsonResponse
    {
        $subscriptions = $this->er->findBy(['partner' => $id_partner], ['inDate' => 'DESC']);

        return new JsonResponse(
            $this->serializer->serialize($subscriptions, 'json'),
            Response::HTTP_OK,
            [],
            true
        );
    }
}
