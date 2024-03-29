<?php

namespace App\Controller;

use App\Entity\Message;
use App\Entity\Picture;
use App\Entity\Trick;
use App\Form\EditTrickType;
use App\Form\MessageType;
use App\Form\NameTrickType;
use App\Form\TrickType;
use App\Repository\MessageRepository;
use App\Repository\PictureRepository;
use App\Repository\TrickRepository;
use App\Repository\VideoRepository;
use App\Service\PictureService;
use App\Service\VideoService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TrickController extends AbstractController
{
    private $coverImageController;
    private $pictureController;
    private $videoController;

    public function __construct(
        CoverImageController $coverImageController,
        PictureController $pictureController,
        VideoController $videoController
    ) {
        $this->coverImageController = $coverImageController;
        $this->pictureController = $pictureController;
        $this->videoController = $videoController;
    }

    #[Route('/trick/new', name: 'trick.new', methods: ['GET', 'POST'])]
    public function new(
        TrickRepository $trickRepository,
        PictureService $pictureService,
        VideoService $videoService,
        Request $request
    ): Response {
        $trick = new Trick();
        $form = $this->createForm(TrickType::class, $trick);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $trick = $form->getData();
            $trick->setUser($this->getUser());

            $trickRepository->add($trick, true);
            $images = $form->get('image')->getData();

            $pictureService->newPicture($trick, $images);

            $videoUrl = $request->request->all()['video'];

            $videoService->newVideo($trick, $videoUrl);

            $this->addFlash(
                'success',
                ' Trick was successfully added !'
            );

            return $this->redirectToRoute('home.index');
        }

        return $this->render('pages/trick/newTrick.html.twig', [
            'activemenu' => 'trickmenu',
            'specialNavbar' => true,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/trick/{slug}', name: 'trick.index', methods: ['GET', 'POST'])]
    public function show(
        Trick $trick,
        PictureRepository $pictureRepository,
        VideoRepository $videoRepository,
        MessageRepository $messageRepository,
        EntityManagerInterface $manager,
        Request $request,
        $slug
    ): Response {
        $picture = new Picture();

        $pictures = $pictureRepository->findBy(['trick' => $trick], ['createdAt' => 'DESC']);
        $videos = $videoRepository->findBy(['trick' => $trick], ['createdAt' => 'DESC']);

        // MODIFICATION COVERIMAGE
        $formCoverImage = $this->coverImageController->editCoverImage($trick, $request, $picture);

        // ADD MESSAGE
        $message = new Message();
        $form = $this->createForm(MessageType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $message->setTrick($trick);
            $message->setUser($this->getUser());

            $manager->persist($message);
            $manager->flush();

            $this->addFlash(
                'success2',
                ' Message added !'
            );

            return $this->redirect($this->generateUrl('trick.index', ['slug' => $slug]).'#card-message');
        }

        // on va chercher le numéro de la page dans l'url, par défaut c'est la page 1
        $page = $request->query->getInt('page', 1);
        // on va chercher la liste des messages
        $messages = $messageRepository->findMessagesPaginated($page, $trick->getSlug(), 10);

        return $this->render('pages/trick/indexTrick.html.twig', [
            'activemenu' => 'trickmenu',
            'specialNavbar' => false,
            'formEditCoverImage' => $formCoverImage,
            'trick' => $trick,
            'pictures' => $pictures,
            'videos' => $videos,
            'messages' => $messages,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/trick/edit/{slug}', name: 'trick.edit', methods: ['GET', 'POST'])]
    public function edit(
        Trick $trick,
        TrickRepository $trickRepository,
        PictureRepository $pictureRepository,
        VideoRepository $videoRepository,
        EntityManagerInterface $manager,
        Request $request,
        $slug
    ): Response {
        $picture = new Picture();
        $pictures = $pictureRepository->findBy(['trick' => $trick], ['createdAt' => 'DESC']);
        $videos = $videoRepository->findBy(['trick' => $trick], ['createdAt' => 'DESC']);

        // MODIFICATION NAME TRICK
        $formNameEdit = $this->createForm(NameTrickType::class, $trick);
        $formNameEdit->handleRequest($request);

        if ($formNameEdit->isSubmitted() && $formNameEdit->isValid()) {
            $trickName = $formNameEdit->getData();

            $manager->persist($trickName);
            $manager->flush();

            $this->addFlash(
                'success',
                'Edit successfully !'
            );

            return $this->redirectToRoute('trick.index', ['slug' => $trick->getSlug()]);
        }

        // MODIFICATION COVERIMAGE
        $formCoverImage = $this->coverImageController->editCoverImage($trick, $request, $picture);

        // AJOUT PICTURE TRICK
        $formPicture = $this->pictureController->addPicture($trick, $picture, $request, $trickRepository, $slug);
        if (!$formPicture) {
            return $this->redirectToRoute('trick.edit', ['slug' => $slug]);
        }

        // MODIFICATION PICTURE TRICK
        $formEditPicture = $this->pictureController->editPicture($trick, $request, $picture);

        // AJOUT VIDEO TRICK
        $formVideo = $this->videoController->addVideo($trick, $request);
        if (!$formVideo) {
            return $this->redirectToRoute('trick.edit', ['slug' => $slug]);
        }

        // MODIFICATION DESCRIPTION & CATEGORIE TRICK
        $formEdit = $this->createForm(EditTrickType::class, $trick);
        $formEdit->handleRequest($request);

        if ($formEdit->isSubmitted() && $formEdit->isValid()) {
            $trick = $formEdit->getData();

            $manager->persist($trick);
            $manager->flush();

            $this->addFlash(
                'success',
                'Edit successfully !'
            );

            return $this->redirectToRoute('trick.index', ['slug' => $trick->getSlug()]);
        }

        return $this->render('pages/trick/editTrick.html.twig', [
            'activemenu' => 'trickmenu',
            'specialNavbar' => false,
            'trick' => $trick,
            'pictures' => $pictures,
            'videos' => $videos,
            'formEditCoverImage' => $formCoverImage,
            'formNameEdit' => $formNameEdit->createView(),
            'formPicture' => $formPicture,
            'formEditPicture' => $formEditPicture,
            'formVideo' => $formVideo,
            'formEdit' => $formEdit->createView(),
        ]);
    }

    #[Route('/trick/delete/{slug}', name: 'trick.delete', methods: ['GET'])]
    public function deleteTrick(
        Trick $trick,
        TrickRepository $trickRepository,
        Filesystem $filesystem,
        EntityManagerInterface $manager,
        $slug
    ): Response {
        $currentUser = $this->getUser();

        if (null !== $currentUser && $trick->getUser() === $currentUser) {
            $removePictures = $trickRepository->findOneBySlug($slug);
            // Delete cover image
            if ($removePictures->getCoverImage()) {
                $filesystem = new Filesystem();
                $path = 'upload/tricks/'.$removePictures->getCoverImage();
                $filesystem->remove([$path]);
            }
            // Delete all pictures by trick
            foreach ($removePictures->getPictures() as $image) {
                $filesystem = new Filesystem();
                $path = 'upload/tricks/'.$image->getPictureLink();
                $filesystem->remove([$path]);
            }

            $manager->remove($trick);
            $manager->flush();

            $this->addFlash(
                'success',
                'Delete successfully !'
            );
        }

        return $this->redirectToRoute('home.index');
    }
}
