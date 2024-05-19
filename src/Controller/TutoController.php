<?php

namespace App\Controller;

use App\Repository\TutoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TutoController extends AbstractController
{
    #[Route('/tuto', name: 'app_tuto')]
    public function index(TutoRepository $tutoRepository): Response
    {
        $tuto = $tutoRepository->findAll();
        
        return $this->render('home/index.html.twig', [
            'tuto' => $tuto,
        ]);
    }
}
