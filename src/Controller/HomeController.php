<?php

namespace App\Controller;

use App\Entity\Trick;
use App\Repository\TrickRepository;
use Doctrine\ORM\EntityManagerInterface;
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

    #[Route('/delete/{id}', name:'home.delete', methods: ['GET'])]
    public function delete(trick $trick, EntityManagerInterface $manager): Response
    {
        $manager->remove($trick);
        $manager->flush();

        $this->addFlash(
            'success',
            'Delete successfully !'
        );
    
        return $this->redirectToRoute('home.index');
    }
}
