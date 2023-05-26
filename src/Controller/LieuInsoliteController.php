<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LieuInsoliteController extends AbstractController
{
    #[Route('/lieu/insolite', name: 'app_lieu_insolite')]
    public function index(): Response
    {
        return $this->render('lieu_insolite/index.html.twig', [
            'controller_name' => 'LieuInsoliteController',
        ]);
    }
}
