<?php

namespace App\Controller;

use App\Entity\Picture;
use App\Entity\Trick;
use App\Form\CoverImageType;
use App\Repository\TrickRepository;
use App\Service\PictureService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CoverImageController extends AbstractController
{
    private $pictureService;

    public function __construct(PictureService $pictureService)
    {
        $this->pictureService = $pictureService;
    }

    public function editCoverImage(Trick $trick, Request $request, Picture $picture)
    {
        $formCoverImage = $this->createForm(CoverImageType::class, $picture);
        $formCoverImage->handleRequest($request);

        if ($formCoverImage->isSubmitted() && $formCoverImage->isValid()) {
            $images = $formCoverImage->get('coverImage')->getData();
            $this->pictureService->newPicture($trick, $images);
        }

        return $formCoverImage->createView();
    }

    #[Route('/coverimage/delete/{slug}', name: 'coverimage.delete', methods: ['GET'])]
    public function deleteCoverImage($slug, Trick $trick, Filesystem $filesystem, TrickRepository $trickRepository): Response
    {
        $filesystem->remove(['upload/tricks/'.$trick->getCoverImage()]);

        $coverImage = $trickRepository->findOneBy(['cover_image' => $trick->getCoverImage()]);
        if ($coverImage) {
            $coverImage->setCoverImage(null);
            $trickRepository->add($coverImage, true);
        }

        return $this->redirectToRoute('trick.edit', ['slug' => $slug]);
    }
}
