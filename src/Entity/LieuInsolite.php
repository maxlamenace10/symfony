<?php

namespace App\Entity;

use App\Entity\LieuInsolite;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


#[ORM\Entity(repositoryClass: ProductRepository::class)] 

class LieuInsolite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?float $longitude = null;

    #[ORM\Column]
    private ?float $latitude = null;

   

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $modifiedAt = null;

    #[ORM\ManyToOne(inversedBy: 'lieuInsolites')]
    #[ORM\JoinColumn(nullable: false)]
    private ?user $user = null;

    #[ORM\OneToMany(mappedBy: 'photos', targetEntity: photos::class)]
    private Collection $photos;

    public function __construct()
    {
        $this->photos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

   
    public function getPhotos(): Collection
    {
        return $this->photos;
    }

    public function addPhoto(Photos $photos): self
    {
        if (!$this->photo->contains($photo)) {
            $this->photo[] = $photo;
            $photo->setLieuInsolite($this);
        }

        return $this;
    }

public function getDatePublication(): ?\DateTimeInterface
{
    return $this->datePublication;
}

public function setDatePublication(\DateTimeInterface $createdAt): self
{
    $this->createdAt = $createdAt;

    return $this;
}

public function getDateModification(): ?\DateTimeInterface
{
    return $this->modifiedAt;
}



public function getUtilisateur(): ?User
{
    return $this->user;
}

public function setUtilisateur(?User $user): self
{
    $this->user = $user;

    return $this;
}

public function setPhoto(array $photo): self
{
    $this->photo = $photo;

    return $this;
}

public function getCreatedAt(): ?\DateTimeImmutable
{
    return $this->createdAt;
}

public function setModifiedAt(\DateTimeImmutable $modifiedAt): self
{
    $this->modifiedAt = $modifiedAt;

    return $this;
}

public function getUser(): ?user
{
    return $this->user;
}

public function setUser(?user $user): self
{
    $this->user = $user;

    return $this;
}

public function removePhoto(photos $photo): self
{
    if ($this->photos->removeElement($photo)) {
        // set the owning side to null (unless already changed)
        if ($photo->getPhotos() === $this) {
            $photo->setPhotos(null);
        }
    }

    return $this;
}

}

