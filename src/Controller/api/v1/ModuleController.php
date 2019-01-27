<?php

namespace App\Controller\api\v1;

use App\Entity\Module;

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
 * Module controller
 *
 * @Route("/api/v1")
 */
final class ModuleController extends AbstractController
{
    /** @var EntityManagerInterface */
    private $em;
    private $er;

    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->er = $em->getRepository(Module::class);
    }



    /**
     * @Route("/modules/{id_module}", methods={"GET"})
     *
     * @param string $id_module
     * @return JsonResponse
     */
    public function getModulesById(string $id_module = ''): JsonResponse
    {
        // TODO: Filtrar solo las lecciones activas
        $module = $this->er->findOneBy(['id' => $id_module, 'active' => true]);

        $module = $this->er->serialize($module);

        return new JsonResponse(
            $module,
            Response::HTTP_OK,
            [],
            true
        );
    }
}
