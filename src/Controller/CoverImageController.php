<?php

namespace App\Controller;

use App\Entity\Trick;
use App\Repository\TrickRepository;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CoverImageController extends AbstractController
{
    #[Route('/coverimage/delete/{slug}', name:'coverimage.delete', methods: ['GET'])]
    public function deleteCoverImage($slug, Trick $trick, Filesystem $filesystem, TrickRepository $trickRepository): Response
    { 
        $filesystem->remove(['upload/'.$trick->getCoverImage()]);
        
        $coverImage = $trickRepository->findOneBy(['cover_image'=>$trick->getCoverImage()]);
        if($coverImage) {
            $coverImage->setCoverImage(NULL);
            $trickRepository->add($coverImage,true);
        }
    
        return $this->redirectToRoute('trick.edit',['slug'=> $slug]);
    }

}

