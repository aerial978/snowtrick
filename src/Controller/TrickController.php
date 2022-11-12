<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TrickController extends AbstractController
{
    #[Route('/trick', name: 'trick.index')]
    public function index(): Response
    {
        $activeMenu = 'trickmenu';
        
        return $this->render('pages/trick/index.html.twig', [
            'activemenu' => $activeMenu,
        ]);
    }

}
