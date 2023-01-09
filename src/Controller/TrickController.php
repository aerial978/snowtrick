<?php

namespace App\Controller;

use App\Entity\Trick;
use App\Entity\Message;
use App\Entity\Picture;
use App\Form\TrickType;
use App\Form\MessageType;
use App\Form\PictureType;
use App\Form\TrickEditType;
use App\Form\CoverImageType;
use App\Service\VideoService;
use App\Service\PictureService;
use App\Repository\TrickRepository;
use App\Repository\MessageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TrickController extends AbstractController
{   
    #[Route('/trick/new', name: 'trick.new', methods: ['GET','POST'])]
    public function new(Request $request, 
    TrickRepository $trickRepository, 
    PictureService $pictureService, 
    VideoService $videoService) : Response
    {
        $trick = new Trick();
        $form = $this->createForm(TrickType::class, $trick);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $trick = $form->getData();

            $trickRepository->add($trick,true);
            // Récupération de l'image(s)
            $images = $form->get('image')->getData();

            // utilisation de pictureService
            $pictureService->newPicture($trick, $images);

            // Récupération de la video(s)
            $videoUrl = $request->request->all()['video'];

            // utilisation de videoService
            $videoService->newVideo($trick, $videoUrl);
            
            $this->addFlash(
                'success',
                ' Trick was successfully added !'
            );
            
            return $this->redirectToRoute('home.index');
        }

        return $this->render('pages/trick/new.html.twig', [
            'activemenu' => 'trickmenu',
            'form' => $form->createView()
        ]);
    }

    #[Route('/trick/edit/{slug}', name:'trick.edit', methods: ['GET','POST'])]
    public function edit(Trick $trick, PictureService $pictureService, EntityManagerInterface $manager, Request $request) : Response
    {
        // Ajout d'une picture d'un trick
        $picture = new Picture();
        $formPicture = $this->createForm(PictureType::class, $picture);
        $formPicture->handleRequest($request);

        if ($formPicture->isSubmitted() && $formPicture->isValid()) {
            $picture = $formPicture->get('newPictureLink')->getData(); 
 
            // Utilisation de pictureService
            $pictureService->newPicture($trick, $picture); 
        }
        
        // Modification picture, description & categorie d'un trick
        $formEdit = $this->createForm(TrickEditType::class, $trick);
        $formEdit->handleRequest($request);

        if ($formEdit->isSubmitted() && $formEdit->isValid()) {    
            $trick = $formEdit->getData();
            
            // Récupération de l'image(s)
            $images = $formEdit->get('image')->getData();
            // Utilisation de pictureService
            $pictureService->newPicture($trick, $images);
           
            $manager->persist($trick);
            $manager->flush();
            
        } 
        
        return $this->render('pages/trick/edit.html.twig', [
            'activemenu' => 'trickmenu',
            'trick' => $trick,
            'formEdit' => $formEdit->createView(),
            'formPicture' => $formPicture->createView()
        ]);
    }

    #[Route('/trick/{slug}', name: 'trick.index', methods: ['GET','POST'])]
    public function index($slug, Trick $trick, MessageRepository $messageRepository, EntityManagerInterface $manager, PaginatorInterface $paginator, Request $request) : Response
    {         
        $message = new Message();
        $form = $this->createForm(MessageType::class, $message);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $message->setTrick($trick);
            $message->setUser($this->getUser());

            $manager->persist($message);
            $manager->flush();

            $this->addFlash(
                'success',
                ' Message was successfully added !'
            );
            return $this->redirect($this->generateUrl('trick.index', array('slug'=>$slug)). '#card-message'); 
        }

        $messages = $paginator->paginate(
            $messageRepository->paginationMessage($trick),
            $request->query->getInt('page', 1),
            2
        ); 
        
        return $this->render('pages/trick/index.html.twig', [
            'activemenu' => 'trickmenu',
            'trick' => $trick,
            'messages' => $messages,
            'form' => $form->createView()
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
