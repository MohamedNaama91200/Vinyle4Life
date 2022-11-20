<?php

namespace App\Entity;

use App\Repository\GalerieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GalerieRepository::class)
 */
class Galerie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $publiee;

   

    /**
     * @ORM\ManyToMany(targetEntity=Objet::class, inversedBy="galeries")
     */
    private $objet;

    /**
     * @ORM\ManyToOne(targetEntity=Membre::class, inversedBy="showroom")
     */
    private $creator;

    public function __construct()
    {
        $this->objet = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function isPubliee(): ?bool
    {
        return $this->publiee;
    }

    public function setPubliee(?bool $publiee): self
    {
        $this->publiee = $publiee;

        return $this;
    }

  /*  public function getCreateur(): ?Membre
    {
        return $this->createur;
    }

    public function setCreateur(?Membre $createur): self
    {
        $this->createur = $createur;

        return $this;
    }
*/
    

    /**
     * @return Collection<int, Objet>
     */
    public function getObjet(): Collection
    {
        return $this->objet;
    }

    public function addObjet(Objet $objet): self
    {
        if (!$this->objet->contains($objet)) {
            $this->objet[] = $objet;
        }

        return $this;
    }

    public function removeObjet(Objet $objet): self
    {
        $this->objet->removeElement($objet);

        return $this;
    }
    public function __toString() 
    {
        $s = '';
        $s .= $this->getDescription() .' ';

        return $s;
    }

    public function getCreator(): ?Membre
    {
        return $this->creator;
    }

    public function setCreator(?Membre $creator): self
    {
        $this->creator = $creator;

        return $this;
    }
}
