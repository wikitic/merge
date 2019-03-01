<?php

namespace App\Controller\v1;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Entity\Course;

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
     * @param SerializerInterface $serializer
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
            $error = [['message' => 'Categoría no disponible']];
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



    /**
     * @IsGranted("ROLE_ADMIN")
     *
     * @Route("/categories", methods={"POST"})
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function postCategories(Request $request): JsonResponse
    {
        $data = json_decode((string)$request->getContent(), true);
        
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->submit($data, true);
        if (!$form->isValid()) {
            $error = $form->getErrors(true);
            return new JsonResponse(
                $this->serializer->serialize($error, 'json'),
                Response::HTTP_BAD_REQUEST,
                [],
                true
            );
        }

        $category->setOrdering($this->er->getNextOrdering());
        $this->em->persist($category);
        $this->em->flush();
        
        return new JsonResponse(
            $this->serializer->serialize($category, 'json'),
            Response::HTTP_OK,
            [],
            true
        );
    }



    /**
     * @IsGranted("ROLE_ADMIN")
     *
     * @Route("/categories/{id_category}", methods={"PATCH", "PUT"})
     *
     * @param Request $request
     * @param string $id_category
     * @return JsonResponse
     */
    public function patchCategories(Request $request, string $id_category = ''): JsonResponse
    {
        $category = $this->er->findOneBy(['id' => $id_category]);
        if ($category === null) {
            $error = [['message' => 'Categoría no existe']];
            return new JsonResponse(
                $this->serializer->serialize($error, 'json'),
                Response::HTTP_BAD_REQUEST,
                [],
                true
            );
        }
        $data = json_decode((string)$request->getContent(), true);
        
        $form = $this->createForm(CategoryType::class, $category);
        $form->submit($data, false);
        if (!$form->isValid()) {
            $error = $form->getErrors(true);
            return new JsonResponse(
                $this->serializer->serialize($error, 'json'),
                Response::HTTP_BAD_REQUEST,
                [],
                true
            );
        }
        $this->em->persist($category);
        $this->em->flush();
        return new JsonResponse(
            $this->serializer->serialize($category, 'json'),
            Response::HTTP_OK,
            [],
            true
        );
    }



    /**
     * @IsGranted("ROLE_ADMIN")
     *
     * @Route("/categories/{id_category}", methods={"DELETE"})
     *
     * @param string $id_category
     * @return JsonResponse
     */
    public function deleteCategories(string $id_category = ''): JsonResponse
    {
        $category = $this->er->findOneBy(['id' => $id_category]);
        if ($category === null) {
            $error = [['message' => 'Categoría no existe']];
            return new JsonResponse(
                $this->serializer->serialize($error, 'json'),
                Response::HTTP_BAD_REQUEST,
                [],
                true
            );
        }
        // Si tiene cursos impedimos borrar
        $courses = $this->em->getRepository(Course::class)->findBy(['category' => $category->getId()]);
        if ($courses) {
            $error = [['message' => 'No se puede borrar una categoría con cursos']];
            return new JsonResponse(
                $this->serializer->serialize($error, 'json'),
                Response::HTTP_NOT_ACCEPTABLE,
                [],
                true
            );
        }
        $this->em->remove($category);
        $this->em->flush();
        
        return new JsonResponse(
            $this->serializer->serialize(null, 'json'),
            Response::HTTP_OK,
            [],
            true
        );
    }
}
