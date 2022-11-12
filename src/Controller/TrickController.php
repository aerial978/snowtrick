<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Trick;
use App\Form\TrickType;
use App\Repository\MessageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TrickController extends AbstractController
{   
    #[Route('/trick/{slug}', name: 'trick.index', methods: ['GET'])]
    public function index(Trick $trick, MessageRepository $messageRepository, PaginatorInterface $paginator, Request $request) : Response
    {
        $messages = $paginator->paginate(
            $messageRepository->paginationMessage($trick),
            $request->query->getInt('page', 1),
            2
        );
        
        return $this->render('pages/trick/index.html.twig', [
            'activemenu' => 'trickmenu',
            'trick' => $trick,
            'messages' => $messages
        ]);
    }

    #[Route('/trick/delete/{id}', name:'trick.delete', methods: ['GET'])]
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
