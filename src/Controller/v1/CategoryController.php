<?php

namespace App\Controller\v1;

use App\Entity\Category;

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

/**
 * Category controller
 *
 * @Route("/v1")
 */
final class CategoryController extends AbstractController
{
    /** @var EntityManagerInterface */
    private $em;
    private $er;

    /** @var SerializerInterface */
    private $serializer;

    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em, SerializerInterface $serializer)
    {
        $this->em = $em;
        $this->er = $em->getRepository(Category::class);

        $this->serializer = $serializer;
    }

    /**
     * @Route("/categories", methods={"GET"})
     *
     * @return JsonResponse
     */
    public function getCategories(): JsonResponse
    {
        $categories = $this->er->findBy([]);

        return new JsonResponse(
            $this->serializer->serialize($categories, 'json'),
            Response::HTTP_OK,
            [],
            true
        );
    }

    /**
     * @Route("/categories/{alias}", methods={"GET"})
     *
     * @param string $alias
     * @return JsonResponse
     */
    public function getCategoriesByAlias(string $alias = ''): JsonResponse
    {
        $category = $this->er->findOneBy(['alias' => $alias, 'active' => true]);
        if ($category === null) {
            $error = ['message' => 'Categoría no disponible'];
            return new JsonResponse(
                $this->serializer->serialize($error, 'json'),
                Response::HTTP_FOUND,
                [],
                true
            );
        }

        return new JsonResponse(
            $this->serializer->serialize($category, 'json'),
            Response::HTTP_OK,
            [],
            true
        );
    }
}
