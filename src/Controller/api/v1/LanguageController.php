<?php

namespace App\Controller\api\v1;

use App\Entity\Language;

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
 * Language controller
 *
 * @Route("/api/v1")
 */
final class LanguageController extends AbstractController
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
        $this->er = $em->getRepository(Language::class);
    }



    /**
     * @Route("/languages/{alias}", methods={"GET"})
     *
     * @param string $alias
     * @return JsonResponse
     */
    public function getLanguagesAlias(string $alias = ''): JsonResponse
    {
        // TODO: Filtrar solo los modulos activos
        $language = $this->er->findOneBy(['alias' => $alias, 'active' => true]);

        $language = $this->er->serialize($language);

        return new JsonResponse(
            $language,
            Response::HTTP_OK,
            [],
            true
        );
    }
}
