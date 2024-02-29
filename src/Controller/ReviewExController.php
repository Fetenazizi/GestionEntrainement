<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReviewExController extends AbstractController
{
    #[Route('/review/ex', name: 'app_review_ex')]
    public function index(): Response
    {
        return $this->render('review_ex/index.html.twig', [
            'controller_name' => 'ReviewExController',
        ]);
    }
}
