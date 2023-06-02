<?php

namespace App\Entity;

use App\Repository\PictureRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: PictureRepository::class)]
class Picture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $pictureLink = null;

    #[Gedmo\Timestampable(on:'create')]
    #[ORM\Column(type:'datetime', nullable : true)]
    protected $createdAt;

    #[Gedmo\Timestampable(on:'update')]
    #[ORM\Column(type:'datetime', nullable : true)]
    protected $updatedAt;

    #[ORM\ManyToOne(inversedBy: 'pictures')]
    #[ORM\JoinColumn(nullable: false, onDelete:"CASCADE")]
    private ?Trick $trick = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPictureLink(): ?string
    {
        return $this->pictureLink;
    }

    public function setPictureLink(string $pictureLink): void
    {
        $this->pictureLink = $pictureLink;                                                                                                   
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }
    
    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    public function getTrick(): ?Trick
    {
        return $this->trick;
    }

    public function setTrick(?Trick $trick): self
    {
        $this->trick = $trick;

        return $this;
    }
}
