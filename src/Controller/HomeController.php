<?php

namespace App\Controller;

use App\Repository\TrickRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home.index', methods: ['GET','POST'])]
    public function index(TrickRepository $trickRepository): Response
    {
        $activeMenu = 'homemenu';
        
        $trick = $trickRepository->findAll();
        
        return $this->render('home.html.twig', [
            'activemenu' => $activeMenu,
            'tricks' => $trick
        ]);
    }
}
