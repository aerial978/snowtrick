<?php

namespace App\Controller;

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
    #[Route('/modify/cover', name: 'app_modify_cover', methods: ['POST'])]
    public function modifyCover(TrickRepository $trickRepository, Request $request): Response
    {
        $coverFile = $request->files->get("cover");
        // récupérer la cover image dans bdd
        $coverImage = $request->request->get("coverImage");
        $trickId = $request->request->get("trickId");

        $cover = $trickRepository->findOneBy(['id'=>$trickId]);

        // FileSystem pour supprimer l'ancienne image
        if ($coverImage != 'default') {
            if ($cover && $cover->getCoverImage() != "snowboarder5.jpg") {
                $filesystem = new Filesystem();
                $path = 'upload/'.$cover->getCoverImage();
                $filesystem->remove([$path]);
            }
        }
                
        // soumettre la nouvelle image
        $newCover = uniqid().'.'.$coverFile->guessExtension();

        try {
            $coverFile->move(
                $this->getParameter('uploads_directory'),$newCover);
        } catch (FileException $e) {
            $this->addFlash(
                'warning',
                'A problem occurred during the download !'
            );
        }

        // remplacer le nom de l'image dans la bdd
        $cover->setCoverImage($newCover);
        $trickRepository->add($cover, true);

        /* renvoyer le nom ou le chemin de l'image dans le $this->json()
        pour le récuperer dans le success AJAX
        pour récuperer l'url source dynamiquement */
        $baseurl = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath();

        return $this->json([
            'cover' => $baseurl.'/upload/'.$newCover,
            'coverImage' => $coverImage
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
            $path = 'upload/'.$picture->getPictureLink();
            $filesystem->remove([$path]);
        }

        // soumettre la nouvelle image
        $newImage = uniqid().'.'.$imagefile->guessExtension();

        try {
            $imagefile->move(
                $this->getParameter('uploads_directory'),$newImage);
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
            'image' => $baseurl.'/upload/'.$newImage,
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
