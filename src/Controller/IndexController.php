<?php

namespace App\Controller;

use App\BundlePartner\Entity\Partner;
use App\BundlePartner\Repository\PartnerRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Index controller
 *
 * @Route("/")
 */
class IndexController extends AbstractController
{
    private $pr;

    public function __construct(RegistryInterface $registry)
    {
        $this->pr = $registry->getRepository(Partner::class, 'partner');
    }

    /**
     * @Route("/{vueRouting}", requirements={"vueRouting"="^(?!api|_(profiler|wdt)).*"}, methods={"GET"})
     *
     * @return Response
     */
    public function index(): Response
    {
        $partner = $this->getUser();

        $partner = $this->pr->serialize($partner);

        return $this->render(
            'base.html.twig',
            [
                'partner' => $partner
            ]
        );
    }
}
