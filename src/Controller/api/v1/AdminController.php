<?php

namespace App\Controller\api\v1;

use App\Entity\Admin;

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
 * Admin controller
 *
 * @Route("/api/v1")
 *
 * @IsGranted("IS_AUTHENTICATED_FULLY")
 */
final class AdminController extends AbstractController
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
        $this->er = $em->getRepository(Admin::class);
        $this->serializer = $serializer;
    }


    /**
     * @Rest\Patch("/admins/{id_admin}", requirements={"id_admin"="\d+"})
     * @return JsonResponse
     */
    public function patchAdmins(Request $request, string $id_admin): JsonResponse
    {
        $admin = $this->er->findOneBy(['id' => $id_admin]);
        if ($admin === null) {
            return new JsonResponse(
                $this->serializer->serialize(null, 'json'),
                Response::HTTP_BAD_REQUEST,
                [],
                true
            );
        }

        if ($request->get('username')!== null) {
            $admin->setUsername($request->get('username'));
        }
        
        if ($request->get('password')!== null) {
            $admin->setPassword($request->get('password'));
        }
        
        $this->em->persist($admin);
        $this->em->flush();

        return new JsonResponse(
            $this->serializer->serialize($admin, 'json'),
            Response::HTTP_OK,
            [],
            true
        );
    }
}
