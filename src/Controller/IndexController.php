<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Safe\json_encode;

class IndexController extends AbstractController
{
    /**
     * @Route("/{vueRouting}", requirements={"vueRouting"="^(?!api|_(profiler|wdt)).*"}, methods={"GET"})
     *
     * @return Response
     */
    public function index(): Response
    {
        $user = $this->getUser();

        return $this->render(
            'base.html.twig',
            [
                'isAuthenticated' => json_encode(!empty($user)),
                'user' => json_encode(!empty($user) ? $user->getUsername() : [])
            ]
        );
    }
}
