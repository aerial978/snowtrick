<?php

namespace App\Service;

use App\Entity\Picture;
use App\Repository\PictureRepository;
use App\Repository\TrickRepository;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class PictureService extends AbstractController
{
    private $pictureRepository;
    private $trickRepository;
    
    public function __construct(PictureRepository $pictureRepository, TrickRepository $trickRepository)
    {
        $this->pictureRepository = $pictureRepository;
        $this->trickRepository = $trickRepository;
    }

    public function newPicture($trick, $images)
    {
        if (!empty($images)) {
        // Boucle sur les images (multiple)
            foreach($images as $index => $image) {
                // Nouveau nom de fichier de l'image (unique)
                $newImage = uniqid().'.'.$image->guessExtension();
                // Copie l'image dans le dossier image
                try {
                    $image->move(
                        $this->getParameter('uploads_directory'),
                        $newImage
                    );
                } catch (FileException $e) {
                    // ... gérer l'exception si quelque chose se produit pendant le téléchargement du fichier
                    $this->addFlash(
                        'warning',
                        'A problem occurred during the download !'
                    );
                }
                // Création image dans la bdd
                $img = new Picture();
                $img->setPictureLink($newImage);
                $img->setTrick($trick);  
                
                $this->pictureRepository->add($img,true);

                if($index == 0) {
                    $trick->setCoverImage($newImage);
                    $this->trickRepository->add($trick,true);
                }
            }
        } else {
            // Erreur message : vous devez uploader au moins une image
            $this->addFlash(
                'warning',
                'You must upload at least one picture !'
            );
        }
    }
}