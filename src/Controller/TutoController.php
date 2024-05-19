<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TutoController extends AbstractController
{
    #[Route('/tuto', name: 'app_tuto')]
    public function index(): Response
    {
        return $this->render('tuto/index.html.twig', [
            'controller_name' => 'TutoController',
        ]);
    }
}
