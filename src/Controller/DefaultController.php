<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Safe\json_encode;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", methods={"GET"})
     *
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('base.html.twig');
    }
}
