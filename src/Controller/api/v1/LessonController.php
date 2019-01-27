<?php

namespace App\Controller\api\v1;

use App\Entity\Lesson;

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
 * Lesson controller
 *
 * @Route("/api/v1")
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
     * @Route("/lessons/{id_lesson}", methods={"GET"})
     *
     * @param string $id_lesson
     * @return JsonResponse
     */
    public function getLessonsById(string $id_lesson = ''): JsonResponse
    {
        // TODO: Filtrar solo las lecciones activas
        $lesson = $this->er->findOneBy(['id' => $id_lesson, 'active' => true]);

        $lesson = $this->er->serialize($lesson);

        return new JsonResponse(
            $lesson,
            Response::HTTP_OK,
            [],
            true
        );
    }
}
