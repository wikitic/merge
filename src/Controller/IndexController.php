<?php

namespace App\Controller;

use App\Entity\Language;
use App\Entity\Module;
use App\Entity\Lesson;

use App\BundlePartner\Entity\Partner;
use App\BundlePartner\Repository\PartnerRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function index(Request $request): Response
    {

        $metas= '';
        //dump($request->getPathInfo()); die;
        /*
        $em = $this->getDoctrine()->getManager();
        $language = $em->getRepository(Language::class)->findOneBy(['alias'=>'blockly']);
        $module = $em->getRepository(Module::class)->findOneBy(['language'=>$language, 'alias'=>'hora-del-codigo']);
        $lesson = $em->getRepository(Lesson::class)->findOneBy(['module'=>$module, 'alias'=>'mi-primer-programa']);
        $metas = $lesson;
        */
        //dump($lesson); die;

        
        $partner = $this->getUser();

        $partner = $this->pr->serialize($partner);

        return $this->render(
            'base.html.twig',
            [
                'metas' => $metas,
                'partner' => $partner
            ]
        );
    }
}
