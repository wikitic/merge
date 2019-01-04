<?php

namespace App\Controller\api\v1;

use App\Entity\Partner;
use App\Entity\Subscription;
use App\Form\PartnerType;

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
use function Safe\json_decode;

/**
 * Partner controller
 *
 * @Route("/api/v1")
 *
 * @IsGranted("IS_AUTHENTICATED_FULLY")
 */
final class PartnerController extends AbstractController
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
        $this->er = $em->getRepository(Partner::class);

        // Evitar "A circular reference has been detected when serializing the object of class"
        $normalizer = new ObjectNormalizer();
        $normalizer->setIgnoredAttributes(['partner']);
        $serializer = new Serializer([$normalizer], [new JsonEncoder()]);
        // Evitar ...
        
        $this->serializer = $serializer;
    }



    /**
     * @Rest\Get("/partners", name="getPartners")
     * @return JsonResponse
     */
    public function getPartners(): JsonResponse
    {
        $partners = $this->er->findBy([]);

        return new JsonResponse(
            $this->serializer->serialize($partners, 'json'),
            Response::HTTP_OK,
            [],
            true
        );
    }



    /**
     * @Route("/partners", name="postPartners" , methods={"POST"})
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function postPartners(Request $request): JsonResponse
    {
        $data = $this->serializer->deserialize($request->getContent(), Partner::class, 'json');

        $partner = $this->er->postValidate($data);
        if ($partner === null) {
            $error = ['error' => 'Bad request'];
            return new JsonResponse(
                $this->serializer->serialize($error, 'json'),
                Response::HTTP_BAD_REQUEST,
                [],
                true
            );
        }

        $this->em->persist($partner);
        $this->em->flush();
        
        return new JsonResponse(
            $this->serializer->serialize($partner, 'json'),
            Response::HTTP_OK,
            [],
            true
        );
    }



    /**
     * @Route("/partners/{id_partner}", methods={"PATCH", "PUT"})
     *
     * @param Request $request
     * @param string $id_partner
     * @return JsonResponse
     */
    public function patchPartners(Request $request, string $id_partner = ''): JsonResponse
    {
        $partner = $this->er->findOneBy(['id' => $id_partner]);
        if ($partner === null) {
            $error = ['error' => 'Bad request'];
            return new JsonResponse(
                $this->serializer->serialize($error, 'json'),
                Response::HTTP_BAD_REQUEST,
                [],
                true
            );
        }

        $data = json_decode((string)$request->getContent(), true);
        if (!$this->er->requestValidate($data)) {
            $error = ['error' => 'Bad request'];
            return new JsonResponse(
                $this->serializer->serialize($error, 'json'),
                Response::HTTP_BAD_REQUEST,
                [],
                true
            );
        }
        
        $form = $this->createForm(PartnerType::class, $partner);
        $form->submit($data, false);
        if (!$form->isValid()) {
            $error = ['error' => 'Bad request'];
            return new JsonResponse(
                $this->serializer->serialize($error, 'json'),
                Response::HTTP_BAD_REQUEST,
                [],
                true
            );
        }

        $this->em->persist($partner);
        $this->em->flush();

        return new JsonResponse(
            $this->serializer->serialize($partner, 'json'),
            Response::HTTP_OK,
            [],
            true
        );
    }


    /**
     * @Route("/partners/{id_partner}", methods={"DELETE"})
     *
     * @param string $id_partner
     * @return JsonResponse
     */
    public function deletePartners(string $id_partner = ''): JsonResponse
    {
        $partner = $this->er->findOneBy(['id' => $id_partner]);
        if ($partner === null) {
            $error = ['error' => 'Bad request'];
            return new JsonResponse(
                $this->serializer->serialize($error, 'json'),
                Response::HTTP_BAD_REQUEST,
                [],
                true
            );
        }

        // Si tiene subscripciones impedimos borrar
        $subscriptions = $this->em->getRepository(Subscription::class)->findBy(['partner' => $partner->getId()]);
        if ($subscriptions) {
            $error = ['error' => 'Not Acceptable'];
            return new JsonResponse(
                $this->serializer->serialize($error, 'json'),
                Response::HTTP_NOT_ACCEPTABLE,
                [],
                true
            );
        }

        $this->em->remove($partner);
        $this->em->flush();
        
        return new JsonResponse(
            $this->serializer->serialize(null, 'json'),
            Response::HTTP_OK,
            [],
            true
        );
    }
}
