<?php

namespace App\Controller;

use App\Entity\Trick;
use App\Repository\TrickRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home.index', methods: ['GET'])]
    public function index(TrickRepository $trickRepository): Response
    {
        $trick = $trickRepository->findBy([], ['createdAt' => 'DESC']);

        return $this->render('pages/home.html.twig', [
            'activemenu' => 'homemenu',
            'specialNavbar' => false,
            'tricks' => $trick,
        ]);
    }

    #[Route('/delete/{id}', name: 'home.delete', methods: ['GET'])]
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
