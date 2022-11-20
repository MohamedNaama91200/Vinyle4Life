<?php

namespace App\Entity;

use App\Repository\MembreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MembreRepository::class)
 */
class Membre
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=Inventaire::class, mappedBy="membre")
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    
   // private $galerie;

    /**
     * @ORM\OneToOne(targetEntity=User::class, cascade={"persist", "remove"})
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=Galerie::class, mappedBy="creator")
     */
    private $showroom;

    /**
     * @ORM\ManyToMany(targetEntity=Objet::class, mappedBy="vinyles")
     */
    private $objets;

    public function __construct()
    {
        $this->nom = new ArrayCollection();
        $this->showroom = new ArrayCollection();
        $this->objets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Inventaire>
     */
    public function getNom(): Collection
    {
        return $this->nom;
    }

    public function addNom(Inventaire $nom): self
    {
        if (!$this->nom->contains($nom)) {
            $this->nom[] = $nom;
            $nom->setMembre($this);
        }

        return $this;
    }

    public function removeNom(Inventaire $nom): self
    {
        if ($this->nom->removeElement($nom)) {
            // set the owning side to null (unless already changed)
            if ($nom->getMembre() === $this) {
                $nom->setMembre(null);
            }
        }

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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
    
  /*  /**
     * @return Collection<int, Galerie>
     */
   /* public function getGalerie(): Collection
    {
        return $this->galerie;
    }

    public function addGalerie(Galerie $galerie): self
    {
        if (!$this->galerie->contains($galerie)) {
            $this->galerie[] = $galerie;
            $galerie->setCreateur($this);
        }

        return $this;
    }

    public function removeGalerie(Galerie $galerie): self
    {
        if ($this->galerie->removeElement($galerie)) {
            // set the owning side to null (unless already changed)
            if ($galerie->getCreateur() === $this) {
                $galerie->setCreateur(null);
            }
        }

        return $this;
    }

    */
    
    public function __toString() 
    {
        $s = '';
        $s .= $this->getName() ;

        return $s;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Galerie>
     */
    public function getShowroom(): Collection
    {
        return $this->showroom;
    }

    public function addShowroom(Galerie $showroom): self
    {
        if (!$this->showroom->contains($showroom)) {
            $this->showroom[] = $showroom;
            $showroom->setCreator($this);
        }

        return $this;
    }

    public function removeShowroom(Galerie $showroom): self
    {
        if ($this->showroom->removeElement($showroom)) {
            // set the owning side to null (unless already changed)
            if ($showroom->getCreator() === $this) {
                $showroom->setCreator(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Objet>
     */
    public function getObjets(): Collection
    {
        return $this->objets;
    }

    public function addObjet(Objet $objet): self
    {
        if (!$this->objets->contains($objet)) {
            $this->objets[] = $objet;
            $objet->addVinyle($this);
        }

        return $this;
    }

    public function removeObjet(Objet $objet): self
    {
        if ($this->objets->removeElement($objet)) {
            $objet->removeVinyle($this);
        }

        return $this;
    }

}
