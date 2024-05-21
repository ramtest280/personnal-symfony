<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\User;
use App\Form\ProductType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class ProductController extends AbstractController
{
    #[Route('/product/create', name: 'app_product', methods:["GET", "POST"])]
    #[IsGranted('ROLE_USER')]
    public function index(Request $request, EntityManagerInterface $em): Response
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $product->setCreatedAt(new \DateTimeImmutable());
            $user = $this->getUser();
            $product->setUtilisateur($user);
            // $product->setUt($user);

            $this->addFlash('success', 'Publication envoyee');
            $em->persist($product);
            $em->flush();
            

            return $this->redirectToRoute('app_home');
        }
        return $this->render('product/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
