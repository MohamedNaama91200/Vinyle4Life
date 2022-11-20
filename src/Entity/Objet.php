<?php

namespace App\Entity;

use App\Repository\ObjetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ObjetRepository::class)
 */
class Objet
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Titre;

    /**
     * @ORM\Column(type="integer")
     */
    private $Nb_de_tours;

    /**
     * @ORM\Column(type="boolean")
     */
    private $Neuf;

    /**
     * @ORM\Column(type="integer")
     */
    private $Annee;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Album;


    /**
     * @ORM\ManyToOne(targetEntity=Inventaire::class, inversedBy="objet")
     */
    private $inventaire;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Duree;

    /**
     * @ORM\ManyToOne(targetEntity=Inventaire::class, inversedBy="Vinyle")
     */
    private $Vinyle;

    /**
     * @ORM\ManyToMany(targetEntity=Format::class, inversedBy="objets")
     */
    private $format;

    /**
     * @ORM\ManyToMany(targetEntity=Style::class, inversedBy="objets")
     */
    private $style;

    /**
     * @ORM\ManyToMany(targetEntity=Galerie::class, mappedBy="objet")
     */
    private $galeries;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="objet")
     */
    private $user;

    /**
     * @ORM\ManyToMany(targetEntity=Membre::class, inversedBy="objets")
     */
    private $vinyles;

    public function __construct()
    {
        $this->format = new ArrayCollection();
        $this->style = new ArrayCollection();
        $this->galeries = new ArrayCollection();
        $this->user = new ArrayCollection();
        $this->vinyles = new ArrayCollection();
    }

  

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTitre(): ?string
    {
        return $this->Titre;
    }

    public function setTitre(string $Titre): self
    {
        $this->Titre = $Titre;

        return $this;
    }

    public function getNbDeTours(): ?int
    {
        return $this->Nb_de_tours;
    }

    public function setNbDeTours(int $Nb_de_tours): self
    {
        $this->Nb_de_tours = $Nb_de_tours;

        return $this;
    }

    public function isNeuf(): ?bool
    {
        return $this->Neuf;
    }

    public function setNeuf(bool $Neuf): self
    {
        $this->Neuf = $Neuf;

        return $this;
    }

    public function getAnnee(): ?int
    {
        return $this->Annee;
    }

    public function setAnnee(int $Annee): self
    {
        $this->Annee = $Annee;

        return $this;
    }

    public function getAlbum(): ?string
    {
        return $this->Album;
    }

    public function setAlbum(string $Album): self
    {
        $this->Album = $Album;

        return $this;
    }

    public function getDurée(): ?string
    {
        return $this->Durée;
    }

    public function setDurée(string $Durée): self
    {
        $this->Durée = $Durée;

        return $this;
    }

    public function getInventaire(): ?Inventaire
    {
        return $this->inventaire;
    }

    public function setInventaire(?Inventaire $inventaire): self
    {
        $this->inventaire = $inventaire;

        return $this;
    }

    public function getDuree(): ?string
    {
        return $this->Duree;
    }

    public function setDuree(string $Duree): self
    {
        $this->Duree = $Duree;

        return $this;
    }

    public function getVinyle(): ?Inventaire
    {
        return $this->Vinyle;
    }

    public function setVinyle(?Inventaire $Vinyle): self
    {
        $this->Vinyle = $Vinyle;

        return $this;
    }
    public function __toString() : String 
    {
        return $this->getTitre() . ' : ' . $this->getAlbum();
    }

    /**
     * @return Collection<int, Format>
     */
    public function getFormat(): Collection
    {
        return $this->format;
    }

    public function addFormat(Format $format): self
    {
        if (!$this->format->contains($format)) {
            $this->format[] = $format;
        }

        return $this;
    }

    public function removeFormat(Format $format): self
    {
        $this->format->removeElement($format);

        return $this;
    }

    /**
     * @return Collection<int, Style>
     */
    public function getStyle(): Collection
    {
        return $this->style;
    }

    public function addStyle(Style $style): self
    {
        if (!$this->style->contains($style)) {
            $this->style[] = $style;
        }

        return $this;
    }

    public function removeStyle(Style $style): self
    {
        $this->style->removeElement($style);

        return $this;
    }

    /**
     * @return Collection<int, Galerie>
     */
    public function getGaleries(): Collection
    {
        return $this->galeries;
    }

    public function addGalery(Galerie $galery): self
    {
        if (!$this->galeries->contains($galery)) {
            $this->galeries[] = $galery;
            $galery->addObjet($this);
        }

        return $this;
    }

    public function removeGalery(Galerie $galery): self
    {
        if ($this->galeries->removeElement($galery)) {
            $galery->removeObjet($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(User $user): self
    {
        if (!$this->user->contains($user)) {
            $this->user[] = $user;
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        $this->user->removeElement($user);

        return $this;
    }

    /**
     * @return Collection<int, Membre>
     */
    public function getVinyles(): Collection
    {
        return $this->vinyles;
    }

    public function addVinyle(Membre $vinyle): self
    {
        if (!$this->vinyles->contains($vinyle)) {
            $this->vinyles[] = $vinyle;
        }

        return $this;
    }

    public function removeVinyle(Membre $vinyle): self
    {
        $this->vinyles->removeElement($vinyle);

        return $this;
    }
   


}
