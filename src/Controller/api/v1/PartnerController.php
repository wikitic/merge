<?php

namespace App\Controller\api\v1;

use App\Entity\Partner;
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




use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;

/**
 * Partner controller
 *
 * @Route("/api/v1")
 *
 * @IsGranted("IS_AUTHENTICATED_FULLY")
 */
final class PartnerController extends AbstractController
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
        $this->er = $em->getRepository(Partner::class);

        // Evitar "A circular reference has been detected when serializing the object of class"
        $normalizer = new ObjectNormalizer();
        $normalizer->setIgnoredAttributes(['partner']);
        $serializer = new Serializer([$normalizer], [new JsonEncoder()]);
        // Evitar ...
        
        $this->serializer = $serializer;
    }



    /**
     * @Rest\Get("/partners", name="getPartners")
     * @return JsonResponse
     */
    public function getPartners(): JsonResponse
    {
        $partners = $this->er->findBy([]);

        return new JsonResponse(
            $this->serializer->serialize($partners, 'json'),
            Response::HTTP_OK,
            [],
            true
        );
    }
}
