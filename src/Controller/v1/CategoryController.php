<?php

namespace App\Controller\v1;

use App\Entity\Category;
use App\Entity\Course;
use App\Form\CategoryType;

use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Category controller
 *
 * @Route("/v1")
 */
final class CategoryController extends FOSRestController
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
     * @Rest\View(serializerGroups={"api_list"})
     *
     * @return View
     */
    public function getCategories(): View
    {
        $categories = $this->er->findBy(['active' => true], ['ordering' => 'ASC']);
        
        return View::create($categories, Response::HTTP_OK);
    }

    /**
     * @Route("/categories/{alias}", methods={"GET"})
     * @Rest\View(serializerGroups={"api_view"})
     *
     * @param string $alias
     * 
     * @return View
     */
    public function getCategoriesByAlias(string $alias = ''): View
    {
        $category = $this->er->findOneBy(['alias' => $alias, 'active' => true]);

        if($category === null){
            return View::create(['message'=>'Not found'], Response::HTTP_NOT_FOUND);
        }
        
        return View::create($category, Response::HTTP_OK);
    }



    /**
     * @IsGranted("ROLE_ADMIN")
     * 
     * @Route("/categories", methods={"POST"})
     * @Rest\View(serializerGroups={"api_view"})
     * 
     * @param Request $request
     * 
     * @return View
     */
    public function postCategories(Request $request): View
    {
        $data = json_decode((string)$request->getContent(), true);
        
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->submit($data, true);
        if (!$form->isValid()) {
            //$error = $form->getErrors(true);
            return View::create(['message' => 'Bad request'], Response::HTTP_BAD_REQUEST);
        }

        $category->setOrdering($this->er->getNextOrdering());
        $this->em->persist($category);
        $this->em->flush();

        return View::create($category, Response::HTTP_OK);
    }



    /**
     * @IsGranted("ROLE_ADMIN")
     * 
     * @Route("/categories/{id_category}", methods={"PATCH"})
     * @Rest\View(serializerGroups={"api_view"})
     * 
     * @param Request $request
     * @param string $id_category
     * 
     * @return View
     */
    public function patchCategories(Request $request, string $id_category): View
    {
        $category = $this->er->findOneBy(['id' => $id_category]);
        if ($category === null) {
            return View::create(['message' => 'Not found'], Response::HTTP_NOT_FOUND);
        }

        $data = json_decode((string)$request->getContent(), true);

        $form = $this->createForm(CategoryType::class, $category);
        $form->submit($data, false);
        if (!$form->isValid()) {
            // $error = $form->getErrors(true);
            return View::create(['message' => 'Bad request'], Response::HTTP_BAD_REQUEST);
        }

        $this->em->persist($category);
        $this->em->flush();

        return View::create($category, Response::HTTP_OK);
    }



    /**
     * @IsGranted("ROLE_ADMIN")
     * 
     * @Route("/categories/{id}", methods={"DELETE"})
     *
     * @param string $id
     * 
     * @return View
     */
    public function deleteCategoriesByAlias(string $id = ''): View
    {
        $category = $this->er->findOneBy(['id' => $id]);

        if($category === null){
            return View::create(['message'=>'Not found'], Response::HTTP_NOT_FOUND);
        }
        
        $courses = $this->em->getRepository(Course::class)->findBy(['category' => $category->getId()]);
        if ($courses) {
            return View::create(['message'=>'Not acceptable'], Response::HTTP_NOT_ACCEPTABLE);
        }
        
        return View::create(['message'=>'successful'], Response::HTTP_OK);
    }
    
}
