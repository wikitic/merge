<?php

namespace App\Controller\api\v1;

use App\Entity\Module;
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
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use function Safe\json_decode;

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

    /** @var SerializerInterface */
    private $serializer;

    /**
     * @param EntityManagerInterface $em
     * @param SerializerInterface $serializer
     */
    public function __construct(EntityManagerInterface $em, SerializerInterface $serializer)
    {
        $this->em = $em;
        $this->er = $em->getRepository(Module::class);

        // Evitar "A circular reference has been detected when serializing the object of class"
        $normalizer = new ObjectNormalizer();
        $normalizer->setIgnoredAttributes(['module']);
        $serializer = new Serializer([new DateTimeNormalizer(), $normalizer], [new JsonEncoder()]);
        // Evitar ...
        
        $this->serializer = $serializer;
    }



    /**
     * @Route("/{module}/lessons", methods={"GET"})
     *
     * @param string $module
     * @return JsonResponse
     */
    public function getModules(string $module = ''): JsonResponse
    {
        $module = $this->er->findBy(['alias' => $module]);

        $lessons = $this->em->getRepository(Lesson::class)->findBy(['module' => $module], ['ordering' => 'ASC']);

        return new JsonResponse(
            $this->serializer->serialize($lessons, 'json'),
            Response::HTTP_OK,
            [],
            true
        );
    }
}
