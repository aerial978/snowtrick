<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController
{
    #[Route('/login', name: 'login.security')]
    public function index(): Response
    {
        return $this->render('pages/security/index.html.twig', [
            'controller_name' => 'SecurityController',
        ]);
    }
}
