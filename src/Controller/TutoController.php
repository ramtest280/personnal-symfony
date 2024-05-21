<?php

namespace App\Controller;

use App\Entity\Tuto;
use App\Form\TutoType;
use App\Repository\TutoRepository;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\String\Slugger\SluggerInterface;

class TutoController extends AbstractController
{
    
    #[Route('/tuto/list', name: 'tuto_list')]
    #[IsGranted('ROLE_USER')]
    public function show(TutoRepository $tutoRepository): Response 
    {
        return $this->render('tuto/index.html.twig', [
            'tutos' => $tutoRepository->findAll(),
        ]);
    }
}
