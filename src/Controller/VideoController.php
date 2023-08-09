<?php

namespace App\Controller;

use App\Entity\Trick;
use App\Entity\Video;
use App\Form\VideoType;
use App\Service\VideoService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VideoController extends AbstractController
{
    private $videoService;

    public function __construct(VideoService $videoService)
    {
        $this->videoService = $videoService;
    }

    public function addVideo(Trick $trick, Request $request)
    {
        $video = new Video();
        $formVideo = $this->createForm(VideoType::class, $video);
        $formVideo->handleRequest($request);

        if ($formVideo->isSubmitted() && $formVideo->isValid()) {
            $video = $formVideo->get('newVideoLink')->getData();
            $this->videoService->newVideo($trick, [$video]);

            return false;
        }

        return $formVideo->createView();
    }

    #[Route('/video/delete/{slug}/{id}', name: 'video.delete', methods: ['GET'])]
    public function deleteVideo($slug, Video $video, EntityManagerInterface $manager): Response
    {
        $manager->remove($video);
        $manager->flush();

        $this->addFlash(
            'success',
            'Delete successfully !'
        );

        return $this->redirectToRoute('trick.edit', ['slug' => $slug]);
    }
}
