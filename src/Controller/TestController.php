<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    #[Route('/test', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('FrontOffice/bfo.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }
    #[Route('/test1', name: 'app_test')]
    public function template(): Response
    {
        return $this->render('BackOffice/bbo.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }
}
