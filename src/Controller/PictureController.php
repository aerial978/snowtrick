<?php

namespace App\Controller;

use App\Entity\Picture;
use App\Entity\Trick;
use App\Form\EditPictureType;
use App\Repository\TrickRepository;
use App\Service\PictureService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PictureController extends AbstractController
{
    private $pictureService;

    public function __construct(PictureService $pictureService)
    {
        $this->pictureService = $pictureService;
    }

    public function editPicture(Trick $trick, Request $request, Picture $picture)
    {
        $formEditPicture = $this->createForm(EditPictureType::class, $picture);
        $formEditPicture->handleRequest($request);

        if ($formEditPicture->isSubmitted() && $formEditPicture->isValid()) {
            $images = $formEditPicture->get('editPicture')->getData();
            $this->pictureService->newPicture($trick, $images);
        }

        return $formEditPicture->createView();
    }

    #[Route('/picture/delete/{slug}/{id}', name: 'picture.delete', methods: ['GET'])]
    public function deletePicture($slug, Picture $picture, TrickRepository $trickRepository, Filesystem $filesystem, EntityManagerInterface $manager): Response
    {
        $filesystem->remove(['upload/'.$picture->getPictureLink()]);

        $trick = $trickRepository->findOneBy(['cover_image' => $picture->getPictureLink()]);
        if ($trick) {
            $trick->setCoverImage(null);
            $trickRepository->add($trick, true);
        }

        $manager->remove($picture);
        $manager->flush();

        $this->addFlash(
            'success',
            'Delete successfully !'
        );

        return $this->redirectToRoute('trick.edit', ['slug' => $slug]);
    }
}
