<?php

namespace App\Controller\api\v1;

use App\Service\PartnerService;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Partner controller
 *
 * @Route("/api/v1")
 * @package App\Controller
 * @IsGranted("IS_AUTHENTICATED_FULLY")
 */
final class PartnerController extends AbstractController
{
    /** @var SerializerInterface */
    private $serializer;

    /** @var PartnerService */
    private $partnerService;

    /**
     * ApiPostController constructor.
     * @param SerializerInterface $serializer
     * @param PartnerService $partnerService
     */
    public function __construct(SerializerInterface $serializer, PartnerService $partnerService)
    {
        $this->serializer = $serializer;
        $this->partnerService = $partnerService;
    }


     /**
     * @Rest\Get("/partners", name="getPartners")
     * @return JsonResponse
     */
    public function getPartners(): JsonResponse
    {
        $partnerService = $this->partnerService->getAll();
        $data = $this->serializer->serialize($partnerService, 'json');

        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }
}
