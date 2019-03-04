<?php

namespace App\Controller\v1;

use App\Entity\Course;

use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Course controller
 *
 * @Route("/v1")
 */
final class CourseController extends AbstractController
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
        $this->er = $em->getRepository(Course::class);
    }

    /**
     * @Route("/courses", methods={"GET"})
     * @Rest\View(serializerGroups={"api_list"})
     *
     * @return View
     */
    public function getCourses(): View
    {
        $categories = $this->er->findBy(['active' => true], ['mdate' => 'DESC']);
        
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

        if ($category === null) {
            return View::create(['message'=>'Not found'], Response::HTTP_NOT_FOUND);
        }
        
        return View::create($category, Response::HTTP_OK);
    }
}
