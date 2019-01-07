<?php

namespace App\Controller\api\v1;

use App\Entity\Partner;
use App\Entity\Subscription;
use App\Form\SubscriptionType;

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
 * Subscription controller
 *
 * @Route("/api/v1")
 *
 * @IsGranted("IS_AUTHENTICATED_FULLY")
 */
final class SubscriptionController extends AbstractController
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
        $this->er = $em->getRepository(Subscription::class);

        // Evitar "A circular reference has been detected when serializing the object of class"
        $normalizer = new ObjectNormalizer();
        $normalizer->setIgnoredAttributes(['subscriptions']);
        $serializer = new Serializer([$normalizer], [new JsonEncoder()]);
        // Evitar ...
        
        $this->serializer = $serializer;
    }



    /**
     * @Route("/subscriptions", methods={"GET"})
     *
     * @return JsonResponse
     */
    public function getSubscriptions(): JsonResponse
    {
        $subscriptions = $this->er->findBy([]);

        return new JsonResponse(
            $this->serializer->serialize($subscriptions, 'json'),
            Response::HTTP_OK,
            [],
            true
        );
    }
    
    /**
     * @Route("/partners/{id_partner}/subscriptions", methods={"GET"})
     *
     * @param string $id_partner
     * @return JsonResponse
     */
    public function getPartnersSubscriptions(string $id_partner = ''): JsonResponse
    {
        $subscriptions = $this->er->findBy(['partner' => $id_partner], ['inDate' => 'DESC']);

        return new JsonResponse(
            $this->serializer->serialize($subscriptions, 'json'),
            Response::HTTP_OK,
            [],
            true
        );
    }



    /**
     * @Route("/partners/{id_partner}/subscriptions", methods={"POST"})
     *
     * @param Request $request
     * @param string $id_partner
     * @return JsonResponse
     */
    public function postSubscriptions(Request $request, string $id_partner = ''): JsonResponse
    {
        $partner = $this->em->getRepository(Partner::class)->findOneBy(['id' => $id_partner]);
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
        $data['partner'] = $id_partner;
        /*
        if (!$this->er->requestValidate($data, 'POST')) {
            $error = ['error' => 'Bad request'];
            return new JsonResponse(
                $this->serializer->serialize($error, 'json'),
                Response::HTTP_BAD_REQUEST,
                [],
                true
            );
        }
        */

        $subscription = new Subscription();
        $form = $this->createForm(SubscriptionType::class, $subscription);
        $form->submit($data, true);
        if (!$form->isValid()) {
            dump((string) $form->getErrors(true, false));
            die;
            $error = ['error' => 'Bad request'];
            return new JsonResponse(
                $this->serializer->serialize($error, 'json'),
                Response::HTTP_BAD_REQUEST,
                [],
                true
            );
        }

        $this->em->persist($subscription);
        $this->em->flush();
        
        return new JsonResponse(
            $this->serializer->serialize($subscription, 'json'),
            Response::HTTP_OK,
            [],
            true
        );
    }
}
