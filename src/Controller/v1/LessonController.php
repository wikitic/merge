<?php

namespace App\Controller\v1;

use App\Entity\Course;
use App\Entity\Lesson;

use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Lesson controller
 *
 * @Route("/v1")
 */
final class LessonController extends AbstractController
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
        $this->er = $em->getRepository(Lesson::class);
    }

    /**
     * @Route("/lessons/{course_alias}", methods={"GET"})
     * @Rest\View(serializerGroups={"api_list"})
     *
     * @param string $course_alias
     *
     * @return View
     */
    public function getLessonsByCourse(string $course_alias = ''): View
    {
        $course = $this->em->getRepository(Course::class)
            ->findOneBy(['alias' => $course_alias, 'active' => true]);
        if ($course === null) {
            return View::create(['message'=>'Not found'], Response::HTTP_NOT_FOUND);
        }

        $lessons = $this->er->findBy(['course' => $course, 'active' => true]);
        
        return View::create($lessons, Response::HTTP_OK);
    }

    /**
     * @Route("/lessons/{course_alias}/{alias}", methods={"GET"})
     * @Rest\View(serializerGroups={"api_view"})
     *
     * @param string $course_alias
     * @param string $alias
     *
     * @return View
     */
    public function getLessonsByCourseByAlias(string $course_alias = '', string $alias = ''): View
    {
        $course = $this->em->getRepository(Course::class)
            ->findOneBy(['alias' => $course_alias, 'active' => true]);
        if ($course === null) {
            return View::create(['message'=>'Not found'], Response::HTTP_NOT_FOUND);
        }

        $lesson = $this->er->findOneBy(['course' => $course, 'alias' => $alias, 'active' => true]);
        if ($lesson === null) {
            return View::create(['message'=>'Not found'], Response::HTTP_NOT_FOUND);
        }
        
        return View::create($lesson, Response::HTTP_OK);
    }
}
