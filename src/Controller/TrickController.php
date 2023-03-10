<?php

namespace App\Controller;

use App\Entity\Trick;
use App\Entity\Video;
use App\Entity\Message;
use App\Entity\Picture;
use App\Form\TrickType;
use App\Form\VideoType;
use App\Form\MessageType;
use App\Form\PictureType;
use App\Form\TrickEditType;
use App\Form\CoverImageType;
use App\Form\EditPictureType;
use App\Service\VideoService;
use App\Service\PictureService;
use App\Repository\TrickRepository;
use App\Repository\MessageRepository;
use App\Repository\PictureRepository;
use App\Repository\VideoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class TrickController extends AbstractController
{   
    #[Route('/trick/new', name: 'trick.new', methods: ['GET','POST'])]
    public function new(TrickRepository $trickRepository, 
    PictureService $pictureService, 
    VideoService $videoService,
    Request $request) : Response
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

        return $this->render('pages/trick/newTrick.html.twig', [
            'activemenu' => 'trickmenu',
            'form' => $form->createView()
        ]);
    }

    #[Route('/trick/edit/{slug}', name:'trick.edit', methods: ['GET','POST'])]
    public function edit(
    Trick $trick,
    TrickRepository $trickRepository,
    PictureRepository $pictureRepository,
    PictureService $pictureService,
    VideoRepository $videoRepository,
    VideoService $videoService, 
    EntityManagerInterface $manager, 
    Request $request,
    $slug) : Response
    {
        $picture = new Picture();

        $pictures = $pictureRepository->findBy(['trick'=>$trick],['createdAt'=>'DESC']);
        $videos = $videoRepository->findBy(['trick'=>$trick],['createdAt'=>'DESC']);
        
        // MODIFICATION COVER IMAGE TRICK
        $formCoverImage = $this->createForm(CoverImageType::class, $picture);
        $formCoverImage->handleRequest($request);

        if ($formCoverImage->isSubmitted() && $formCoverImage->isValid()) {   
            
            // Récupération de l'image(s)
            $coverImage = $formCoverImage->get('coverImage')->getData();
            
            // Utilisation de pictureService
            $pictureService->newPicture($trick, $coverImage);   
        }
        
        // AJOUT PICTURE TRICK
        $formPicture = $this->createForm(PictureType::class, $picture);
        $formPicture->handleRequest($request);

        if ($formPicture->isSubmitted() && $formPicture->isValid()) {

             // Récupération de l'image(s)
            $picture = $formPicture->get('newPictureLink')->getData(); 
    
            // Utilisation de pictureService
            $removePicture = $trickRepository->findOneBySlug($slug);
            if ($removePicture->getCoverImage()) {
                $filesystem = new Filesystem();
                $path = 'upload/'.$removePicture->getCoverImage();
                $filesystem->remove([$path]);
            }

            $pictureService->newPicture($trick, [$picture]);
            return $this->redirectToRoute('trick.edit',['slug'=> $slug]);
        }

        // MODIFICATION PICTURE TRICK
        $formEditPicture = $this->createForm(EditPictureType::class, $picture);
        $formEditPicture->handleRequest($request);

        if ($formEditPicture->isSubmitted() && $formEditPicture->isValid()) {   
            
            // Récupération de l'image(s)
            $images = $formEditPicture->get('editPicture')->getData();
            
            // Utilisation de pictureService
            $pictureService->newPicture($trick, $images);   
        }

        // AJOUT VIDEO TRICK
        $video = new Video();
        $formVideo = $this->createForm(VideoType::class, $video);
        $formVideo->handleRequest($request);

        if ($formVideo->isSubmitted() && $formVideo->isValid()) {

             // Récupération de l'image(s)
            $video = $formVideo->get('newVideoLink')->getData(); 
    
            // Utilisation de pictureService
            $videoService->newVideo($trick, [$video]);
            return $this->redirectToRoute('trick.edit',['slug'=> $slug]);
        }
        
        // MODIFICATION DESCRIPTION & CATEGORIE TRICK
        $formEdit = $this->createForm(TrickEditType::class, $trick);
        $formEdit->handleRequest($request);

        if ($formEdit->isSubmitted() && $formEdit->isValid()) {    
            $trick = $formEdit->getData();
           
            $manager->persist($trick);
            $manager->flush();   
        } 
        
        return $this->render('pages/trick/editTrick.html.twig', [
            'activemenu' => 'trickmenu',
            'trick' => $trick,
            'pictures' => $pictures,
            'videos' => $videos,
            'formEditCoverImage' => $formCoverImage->createView(),
            'formPicture' => $formPicture->createView(),
            'formEditPicture' => $formEditPicture->createView(),
            'formVideo' => $formVideo->createView(),
            'formEdit' => $formEdit->createView(),    
        ]);
    }

    #[Route('/trick/{slug}', name: 'trick.index', methods: ['GET','POST'])]
    public function index($slug, 
    Trick $trick,
    PictureService $pictureService,
    PictureRepository $pictureRepository,
    VideoRepository $videoRepository,
    MessageRepository $messageRepository, 
    EntityManagerInterface $manager, 
    PaginatorInterface $paginator, 
    Request $request) : Response
    {         
        if (!$trick) {
            throw $this->createNotFoundException('The product does not exist');
        }
        
        $picture = new Picture();

        $pictures = $pictureRepository->findBy(['trick'=>$trick],['createdAt'=>'DESC']);
        $videos = $videoRepository->findBy(['trick'=>$trick],['createdAt'=>'DESC']);
        
        // MODIFICATION COVER IMAGE TRICK
        $formCoverImage = $this->createForm(CoverImageType::class, $picture);
        $formCoverImage->handleRequest($request);

        if ($formCoverImage->isSubmitted() && $formCoverImage->isValid()) {   
            
            // Récupération de l'image(s)
            $coverImage = $formCoverImage->get('coverImage')->getData();
            
            // Utilisation de pictureService
            $pictureService->newPicture($trick, $coverImage);   
        } 
        
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
        
        return $this->render('pages/trick/indexTrick.html.twig', [
            'activemenu' => 'trickmenu',
            'formEditCoverImage' => $formCoverImage->createView(),
            'trick' => $trick,
            'pictures' => $pictures,
            'videos' => $videos,
            'messages' => $messages,
            'form' => $form->createView()
        ]);
    }

    #[Route('/trick/delete/{slug}', name:'trick.delete', methods: ['GET'])]
    public function deleteTrick(Trick $trick, TrickRepository $trickRepository, Filesystem $filesystem, EntityManagerInterface $manager, $slug): Response
    {        
        $removePictures = $trickRepository->findOneBySlug($slug);
        // Delete cover image
        if ($removePictures->getCoverImage()) {
            $filesystem = new Filesystem();
            $path = 'upload/'.$removePictures->getCoverImage();
            $filesystem->remove([$path]);
        }
        // Delete all pictures by trick
        foreach ($removePictures->getPictures() as $image) {
            $filesystem = new Filesystem();
            $path = 'upload/'.$image->getPictureLink();
            $filesystem->remove([$path]);
        }

        $manager->remove($trick);
        $manager->flush();

        $this->addFlash(
            'success',
            'Delete successfully !'
        );
        return $this->redirectToRoute('home.index');
    }
}

