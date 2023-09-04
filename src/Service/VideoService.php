<?php

namespace App\Service;

use App\Entity\Video;
use App\Repository\VideoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class VideoService extends AbstractController
{
    private $videoRepository;

    public function __construct(VideoRepository $videoRepository)
    {
        $this->videoRepository = $videoRepository;
    }

    public function newVideo($trick, array $videoUrl)
    {
        if (!empty($videoUrl)) {
            foreach ($videoUrl as $newVideo) {
                if (str_starts_with($newVideo, 'https://www.youtube.com/watch?')) {
                    $explode = explode('?', $newVideo);

                    $arguments = explode('&', $explode[1]);

                    foreach ($arguments as $argument) {
                        if (str_starts_with($argument, 'v=')) {
                            $videoLink = str_replace('v=', '', $argument);
                            // Création video dans la bdd
                            $video = new Video();
                            $video->setVideoLink($videoLink);
                            $video->setTrick($trick);
                            $this->videoRepository->add($video, true);
                        }
                    }
                }
            }
        } else {
            // Erreur message : vous devez uploader au moins une video
            $this->addFlash(
                'warning',
                'You must upload at least one video !'
            );
        }
    }
}
