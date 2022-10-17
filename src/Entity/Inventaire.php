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
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=Membre::class, inversedBy="nom")
     */
    private $membre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Titre;

    
    

    public function __construct()
    {
        $this->description = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Objet>
     */
    public function getDescription(): Collection
    {
        return $this->description;
    }

    public function addDescription(Objet $description): self
    {
        if (!$this->description->contains($description)) {
            $this->description[] = $description;
            $description->setInventaire($this);
        }

        return $this;
    }

    public function removeDescription(Objet $description): self
    {
        if ($this->description->removeElement($description)) {
            // set the owning side to null (unless already changed)
            if ($description->getInventaire() === $this) {
                $description->setInventaire(null);
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
}
