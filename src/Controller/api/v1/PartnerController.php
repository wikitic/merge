<?php

namespace App\Controller\api\v1;

use App\Entity\Partner;
use App\Service\PartnerService;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\Serializer\SerializerInterface;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\View\View;


class PartnerController extends AbstractController
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
     * @Rest\Get("/api/v1/partners", name="getAllPosts")
     * @return JsonResponse
     */
    public function getAllActions(): JsonResponse
    {
        $partnerService = $this->partnerService->getAll();
        $data = $this->serializer->serialize($partnerService, 'json');

        return new JsonResponse($data, 200, [], true);
    }





    /**
     * @Route("/api/v1/autors", methods={"GET"})
     * @param Request $request
     */
    public function getPartners(Request $request): View
    {        
        $em = $this->getDoctrine()->getManager();
        $partners = $em->getRepository(Partner::class)->findBy([]);
                
        return View::create($partners, Response::HTTP_OK);
    }


}
