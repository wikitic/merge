<?php

namespace App\Controller\v1;

use App\Entity\Category;
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
        $courses = $this->er->findBy(['active' => true], ['mdate' => 'DESC']);
        
        return View::create($courses, Response::HTTP_OK);
    }

    /**
     * @Route("/courses/{category_alias}", methods={"GET"})
     * @Rest\View(serializerGroups={"api_list"})
     *
     * @param string $category_alias
     *
     * @return View
     */
    public function getCoursesByCategory(string $category_alias = ''): View
    {
        $category = $this->em->getRepository(Category::class)->findOneBy(['alias' => $category_alias, 'active' => true]);
        if ($category === null) {
            return View::create(['message'=>'Not found'], Response::HTTP_NOT_FOUND);
        }

        $courses = $this->er->findBy(['category' => $category, 'active' => true]);
        
        return View::create($courses, Response::HTTP_OK);
    }

    /**
     * @Route("/courses/{category_alias}/{alias}", methods={"GET"})
     * @Rest\View(serializerGroups={"api_view"})
     *
     * @param string $category_alias
     * @param string $alias
     *
     * @return View
     */
    public function getCoursesByCategoryByAlias(string $category_alias = '', string $alias = ''): View
    {
        $category = $this->em->getRepository(Category::class)->findOneBy(['alias' => $category_alias, 'active' => true]);
        if ($category === null) {
            return View::create(['message'=>'Not found'], Response::HTTP_NOT_FOUND);
        }

        $course = $this->er->findOneBy(['category' => $category, 'alias' => $alias, 'active' => true]);
        if ($course === null) {
            return View::create(['message'=>'Not found'], Response::HTTP_NOT_FOUND);
        }
        
        return View::create($course, Response::HTTP_OK);
    }
}
