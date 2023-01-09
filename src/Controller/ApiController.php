<?php

namespace App\Controller;

use App\Entity\Trick;
use App\Repository\TrickRepository;
use App\Repository\VideoRepository;
use App\Repository\PictureRepository;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class ApiController extends AbstractController
{
    #[Route('/modify/coverimage', name: 'app_modify_cover', methods: ['GET','POST'])]
    public function modifyCoverImage(Trick $trick, TrickRepository $trickRepository, Request $request): Response
    {
            $coverImageFile = $request->files->get("coverImage");
            $trickId = $request->request->get("Id");

            $coverImage = $trickRepository->findOneBy(['id'=>$trick->getId()]);
            if ($coverImage) {
                $filesystem = new Filesystem();
                $path = 'public/images/'.$coverImageFile->getCoverImage();
                $filesystem->remove([$path]);
            }

            $newCoverImage = uniqid().'.'.$path->guessExtension();

            try {
                $path->move(
                    $this->getParameter('uploads_directory'),
                    $newCoverImage
                );
            } catch (FileException $e) {
                $this->addFlash(
                    'warning',
                    'A problem occurred during the download !'
                );
            }

            $coverImage->setCoverImage($newCoverImage);
            $trickRepository->add($coverImage, true);

    //  }

    $baseurl = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath();

    return $this->json([
        'coverImage' => $baseurl.'/images/'.$coverImageFile,
        'trickId' => $trickId
    ]);

    }
    
    #[Route('/modify/picture', name: 'app_modify_picture', methods: ['POST'])]
    public function modifyPicture(PictureRepository $pictureRepository, Request $request): Response
    {
        $imagefile = $request->files->get("image");
        // récupérer l'ID
        $pictureId = $request->request->get("pictureId");

        // FileSystem pour supprimer l'ancienne image
        $picture = $pictureRepository->findOneBy(['id'=>$pictureId]);
        if ($picture) {
            $filesystem = new Filesystem();
            $path = 'public/images/'.$picture->getPictureLink();
            $filesystem->remove([$path]);
        }

        // soumettre la nouvelle image
        $newImage = uniqid().'.'.$imagefile->guessExtension();

        try {
            $imagefile->move(
                $this->getParameter('uploads_directory'),
                $newImage
            );
        } catch (FileException $e) {
            $this->addFlash(
                'warning',
                'A problem occurred during the download !'
            );
        }

        // remplacer le nom de l'image dans la bdd
        $picture->setPictureLink($newImage);
        $pictureRepository->add($picture, true);

        /* renvoyer le nom ou le chemin de l'image dans le $this->json()
        pour le récuperer dans le success AJAX
        pour récuperer l'url source dynamiquement */
        $baseurl = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath();

        return $this->json([
            'image' => $baseurl.'/images/'.$newImage,
            'pictureId' => $pictureId
        ]);
    }

    #[Route('/modify/video', name: 'app_modify_video', methods: ['POST'])]
    public function modifyVideo(VideoRepository $videoRepository, Request $request): Response
    {
        $videoUrl = $request->request->get("video_url");
        // récupérer l'ID
        $videoId = $request->request->get("videoId");

        $editVideo = $videoRepository->findOneBy(['id'=>$videoId]);

        if (str_starts_with($videoUrl, 'https://www.youtube.com/watch?')) {

            $explode = explode('?', $videoUrl);

            $arguments = explode('&', $explode[1]);

            foreach ($arguments as $argument){
                if (str_starts_with($argument, 'v=')){
                    $videoLink = str_replace('v=', '', $argument);
                    $editVideo->setVideoLink($videoLink);
                    $videoRepository->add($editVideo, true);   
                }
            }
        } 
        
        return $this->json([
            'video_url' => 'https://www.youtube.com/embed/'.$videoLink,
            'videoId' => $videoId
        ]);
    }
}
