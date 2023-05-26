<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]

class User 
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $avatar = null;

    #[ORM\Column(length: 255)]
    private ?string $pseudo = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: LieuInsolite::class)]
    private Collection $lieuInsolites;

    public function __construct()
    {
        $this->lieuInsolites = new ArrayCollection();
    }


    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }
    public function getId(): ?int
    {
        
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }
     /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }
   
    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }




    /**
     * Get the value of pseudo
     *
     * @return ?string
     */
    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }


    /**
     * Set the value of pseudo
     *
     * @param ?string $pseudo
     *
     * @return self
     */
    public function setPseudo(?string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    /**
     * Get the value of avatar
     *
     * @return ?string
     */
    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    /**
     * Set the value of avatar
     *
     * @param ?string $avatar
     *
     * @return self
     */
    public function setAvatar(?string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * Get the value of prenom
     *
     * @return ?string
     */
    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    /**
     * Set the value of prenom
     *
     * @param ?string $prenom
     *
     * @return self
     */
    public function setPrenom(?string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get the value of nom
     *
     * @return ?string
     */
    public function getNom(): ?string
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @param ?string $nom
     *
     * @return self
     */
    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection<int, LieuInsolite>
     */
    public function getLieuInsolites(): Collection
    {
        return $this->lieuInsolites;
    }

    public function addLieuInsolite(LieuInsolite $lieuInsolite): self
    {
        if (!$this->lieuInsolites->contains($lieuInsolite)) {
            $this->lieuInsolites->add($lieuInsolite);
            $lieuInsolite->setUser($this);
        }

        return $this;
    }

    public function removeLieuInsolite(LieuInsolite $lieuInsolite): self
    {
        if ($this->lieuInsolites->removeElement($lieuInsolite)) {
            // set the owning side to null (unless already changed)
            if ($lieuInsolite->getUser() === $this) {
                $lieuInsolite->setUser(null);
            }
        }

        return $this;
    }
}