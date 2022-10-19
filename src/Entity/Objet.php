<?php

namespace App\Entity;

use App\Repository\ObjetRepository;
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
        return $this->getTitre();
    }

}
