<?php

namespace App\Controller;

use App\Entity\Video;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class VideoController extends AbstractController
{
    #[Route('/video/delete/{slug}/{id}', name: 'video.delete', methods: ['GET'])]
    public function deleteVideo($slug, Video $video, EntityManagerInterface $manager): Response
    {
        $manager->remove($video);
        $manager->flush();

        $this->addFlash(
            'success',
            'Delete successfully !'
        );
    
        return $this->redirectToRoute('trick.edit',['slug'=> $slug]);
    }

}
