<?php

namespace App\Entity;

use App\Repository\InventaireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InventaireRepository::class)
 */
class Inventaire
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
     
    /**
     * @ORM\OneToMany(targetEntity=Objet::class, mappedBy="inventaire")
     */
    private $objet;

    /**
     * @ORM\ManyToOne(targetEntity=Membre::class, inversedBy="nom")
     */
    private $membre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Titre;

    /**
     * @ORM\OneToMany(targetEntity=Objet::class, mappedBy="Vinyle")
     */
    private $Vinyle;

    
    

    public function __construct()
    {
        $this->objet = new ArrayCollection();
        $this->Vinyle = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Objet>
     */
    public function getobjet(): Collection
    {
        return $this->objet;
    }

    public function addobjet(Objet $objet): self
    {
        if (!$this->objet->contains($objet)) {
            $this->objet[] = $objet;
            $objet->setInventaire($this);
        }

        return $this;
    }

    public function removeobjet(Objet $objet): self
    {
        if ($this->objet->removeElement($objet)) {
            // set the owning side to null (unless already changed)
            if ($objet->getInventaire() === $this) {
                $objet->setInventaire(null);
            }
        }

        return $this;
    }

    public function getMembre(): ?Membre
    {
        return $this->membre;
    }

    public function setMembre(?Membre $membre): self
    {
        $this->membre = $membre;

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

    /**
     * @return Collection<int, Objet>
     */
    public function getVinyle(): Collection
    {
        return $this->Vinyle;
    }

    public function addVinyle(Objet $vinyle): self
    {
        if (!$this->Vinyle->contains($vinyle)) {
            $this->Vinyle[] = $vinyle;
            $vinyle->setVinyle($this);
        }

        return $this;
    }

    public function removeVinyle(Objet $vinyle): self
    {
        if ($this->Vinyle->removeElement($vinyle)) {
            // set the owning side to null (unless already changed)
            if ($vinyle->getVinyle() === $this) {
                $vinyle->setVinyle(null);
            }
        }

        return $this;
    }
}
